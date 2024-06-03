<?php

namespace CookieConsent;

class CookieConsent
{
    private $cookieName = 'user_consent';

    public function __construct()
    {
        // Initialisation si nécessaire
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
            echo <<<HTML
            <div id="consent-banner" style="position: fixed; bottom: 0; background: #000; color: #fff; width: 100%; padding: 10px; text-align: center;">
                <form method="POST" style="display: inline;">
                    Ce site utilise des cookies pour améliorer votre expérience. Acceptez-vous l'utilisation des cookies ?
                    <button name="consent" value="yes">Oui</button>
                    <button name="consent" value="no">Non</button>
                </form>
            </div>
            <script src="consent.js"></script>
            HTML;
        }
    }
}
