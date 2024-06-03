<?php

require __DIR__ . '/../vendor/autoload.php';

use CookieConsent\CookieConsent;

// Définir la langue par défaut à 'fr'
$lang = 'cre';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exemple de Consentement de Cookies</title>
    <script src="consent.js"></script>
</head>
<body>
<h1>Bienvenue sur notre site</h1>
<p>Ce site utilise des cookies pour améliorer votre expérience.</p>

<?php
$consent->renderConsentBanner();
?>
<script>
    const userConfig = {
        banner: {
            backgroundColor: document.body.dataset.consentBgColor || '#2c3e50',
            color: document.body.dataset.consentTextColor || '#ecf0f1',
            fontFamily: document.body.dataset.consentFontFamily || 'Verdana, sans-serif',
        },
        buttons: {
            backgroundColor: document.body.dataset.consentButtonBgColor || '#3498db',
            color: document.body.dataset.consentButtonTextColor || '#fff',
            borderRadius: document.body.dataset.consentButtonBorderRadius || '1rem',
            padding: document.body.dataset.consentButtonPadding || '.5em 1em',
            border: document.body.dataset.consentButtonBorder || 'none',
            margin: document.body.dataset.consentButtonMargin || '5px',
            cursor: 'pointer'
        }
    };
</script>
</body>
</html>
