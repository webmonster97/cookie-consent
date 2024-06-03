<?php

namespace CookieConsent;

class CookieConsent
{
    private $cookieName = 'user_consent';
    private $lang;
    private $translations;

    public function __construct($lang = 'fr')
    {
        $this->lang = $lang;
        $this->loadTranslations();
    }

    private function loadTranslations()
    {
        $filePath = __DIR__ . '/../lang/' . $this->lang . '.php';
        if (file_exists($filePath)) {
            $this->translations = include $filePath;
        } else {
            // Fallback to French if the language file doesn't exist
            $this->translations = include __DIR__ . '/../lang/fr.php';
        }
    }

    public function isConsented(): bool
    {
        return isset($_COOKIE[$this->cookieName]) && $_COOKIE[$this->cookieName] === 'yes';
    }

    public function handleConsent()
    {
        if (isset($_POST['consent'])) {
            if ($_POST['consent'] === 'yes') {
                setcookie($this->cookieName, 'yes', time() + 365 * 24 * 60 * 60, "/");
            } else {
                setcookie($this->cookieName, '', time() - 3600, "/"); // Supprimer le cookie
            }
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
    }

    public function renderConsentBanner()
    {
        if (!$this->isConsented()) {
            $message = $this->translations['message'];
            $accept = $this->translations['accept'];
            $reject = $this->translations['reject'];

            echo <<<HTML
            <div id="consent-banner" style="position: fixed; bottom: 0; width: 100%; padding: 10px; text-align: center;">
                <form method="POST" style="display: inline;">
                    <span id="consent-message">$message</span>
                    <button name="consent" value="yes">$accept</button>
                    <button name="consent" value="no">$reject</button>
                </form>
            </div>
            HTML;
        }
    }
}
