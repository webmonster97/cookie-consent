# Documentation de la bibliothèque de gestion du consentement des cookies

## Description

Cette bibliothèque PHP permet de gérer le consentement des cookies conformément aux réglementations RGPD. Lorsqu'un utilisateur arrive sur une page, un message de consentement aux cookies est affiché. L'utilisateur peut accepter ou refuser l'utilisation des cookies. Si l'utilisateur accepte, le message ne s'affiche plus lors des visites ultérieures. Si l'utilisateur refuse, aucun cookie n'est utilisé. La bibliothèque supporte plusieurs langues.

## Installation

### 1. Cloner le dépôt :

```bash
git clone https://github.com/webmonster97/cookie-consent.git
cd cookie-consent
```
### 2. Installer les dépendances via Composer :

```bash
composer install
```
## Utilisation

### 1. Inclure la bibliothèque dans votre projet :

Assurez-vous que l'autoloader de Composer est inclus dans votre fichier PHP principal.

```php
require __DIR__ . '/vendor/autoload.php';

use CookieConsent\CookieConsent;

// Définir la langue par défaut à 'fr'
$lang = 'fr';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre', 'mq'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();
```
### 2. Afficher la bannière de consentement :

Appelez la méthode `renderConsentBanner()` pour afficher la bannière de consentement dans votre page.

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exemple de Consentement de Cookies</title>
</head>
<body>
    <h1>Bienvenue sur notre site</h1>
    <p>Ce site utilise des cookies pour améliorer votre expérience.</p>

    <?php
        $consent->renderConsentBanner();
    ?>
</body>
</html>
```
### 3. Ajouter le script JavaScript :

Assurez-vous que le fichier JavaScript consent.js est chargé correctement dans votre page.

```html
<script src="public/consent.js"></script>
```

## Configuration

Vous pouvez personnaliser la bannière de consentement en modifiant les styles via JavaScript et choisir la langue du message en passant un paramètre dans l'URL.

### 1. Fichier `consent.js` :

Ce fichier permet de personnaliser dynamiquement les styles de la bannière et des boutons.

```javascript
document.addEventListener("DOMContentLoaded", function() {
    const consentBanner = document.getElementById('consent-banner');
    const consentButtons = consentBanner.querySelectorAll('button');

    if (consentBanner) {
        const userConfig = {
            banner: {
                backgroundColor: document.body.dataset.consentBgColor || '#2c3e50',
                color: document.body.dataset.consentTextColor || '#ecf0f1',
                fontFamily: document.body.dataset.consentFontFamily || 'Verdana, sans-serif',
            },
            buttons: {
                backgroundColor: document.body.dataset.consentButtonBgColor || '#3498db',
                color: document.body.dataset.consentButtonTextColor || '#fff',
                borderRadius: document.body.dataset.consentButtonBorderRadius || '5px',
                padding: document.body.dataset.consentButtonPadding || '10px 20px',
                border: document.body.dataset.consentButtonBorder || 'none',
                margin: document.body.dataset.consentButtonMargin || '5px',
                cursor: 'pointer'
            }
        };

        // Appliquer les styles de la bannière
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // Appliquer les styles des boutons
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});
```

### 2. Personnalisation via les attributs `data-*` :

Vous pouvez personnaliser les styles directement dans le HTML en utilisant les attributs data-*.

```html
<body
    data-consent-bg-color="#2c3e50"
    data-consent-text-color="#ecf0f1"
    data-consent-font-family="Verdana, sans-serif"
    data-consent-button-bg-color="#3498db"
    data-consent-button-text-color="#fff"
    data-consent-button-border-radius="5px"
    data-consent-button-padding="10px 20px"
    data-consent-button-border="none"
    data-consent-button-margin="5px">
    ...
</body>
```

### 3. Choix de la langue :

L'utilisateur peut choisir la langue du message de consentement en ajoutant un paramètre `lang` à l'URL, par exemple :

```html
http://votre-site.com/?lang=fr
```
Les langues disponibles sont : `en` (Anglais), `zh` (Chinois), `hi` (Hindi), `es` (Espagnol), `fr` (Français), `cre` (Créole), `mq` (Créole martiniquais).

## Crédits

Cette bibliothèque a été développée par Webmonster.tech. Elle est distribuée sous MIT Licence. Pour plus d'informations, veuillez consulter le dépôt GitHub https://github.com/webmonster97.