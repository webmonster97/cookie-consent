# Cookie Consent Management Library Documentation

## Description

This PHP library manages cookie consent in accordance with GDPR regulations. When a user arrives on a page, a cookie consent message is displayed. The user can accept or refuse the use of cookies. If the user accepts, the message will no longer be displayed during subsequent visits. If the user refuses, no cookies are used. The library supports multiple languages.

## Installation

### 1. Clone the repository:

```bash
git clone https://github.com/webmonster97/cookie-consent.git
cd cookie-consent
```

### 2. Install dependencies via Composer:

```bash
composer install
```

## Usage

### 1. Include the library in your project:

Ensure that the Composer autoloader is included in your main PHP file.

```php
require __DIR__ . '/vendor/autoload.php';

use CookieConsent\CookieConsent;

// Set the default language to 'fr'
$lang = 'fr';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre', 'mq'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();
```

### 2. Display the consent banner:

Call the `renderConsentBanner()` method to display the consent banner on your page.

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cookie Consent Example</title>
</head>
<body>
    <h1>Welcome to our site</h1>
    <p>This site uses cookies to enhance your experience.</p>

    <?php
        $consent->renderConsentBanner();
    ?>
</body>
</html>
```

### 3. Add the JavaScript script:

Ensure that the `consent.js` JavaScript file is correctly loaded on your page.

```html
<script src="public/consent.js"></script>
```

## Configuration

You can customize the consent banner by modifying the styles via JavaScript and choosing the language of the message by passing a parameter in the URL.

### 1. `consent.js` file:

This file allows dynamic customization of the banner and button styles.

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

        // Apply banner styles
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // Apply button styles
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});
```

### 2. Customization via `data-*` attributes:

You can customize styles directly in HTML using `data-*` attributes.

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

### 3. Language choice:

The user can choose the language of the consent message by adding a `lang` parameter to the URL, for example:

```html
http://your-site.com/?lang=fr
```

Available languages are: `en` (English), `zh` (Chinese), `hi` (Hindi), `es` (Spanish), `fr` (French), `cre` (Creole), `mq` (Martinican Creole).

## Credits

This library was developed by Webmonster.tech. It is distributed under the MIT License. For more information, please visit the GitHub repository at https://github.com/webmonster97.