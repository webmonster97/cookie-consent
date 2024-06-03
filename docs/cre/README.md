# Dokimantasyon Bibliyotèk Jesyon Akòzman pou Bonbon

## Deskripsyon

Bibliyotèk PHP sa a pèmèt jere konsantman bonbon an akò avèk règleman GDPR yo. Lè yon itilizatè rive sou yon paj, yon mesaj konsantman pou bonbon ap parèt. Itilizatè a ka aksepte oswa refize itilizasyon bonbon yo. Si itilizatè a aksepte, mesaj la p ap parèt ankò pandan vizit kap vini yo. Si itilizatè a refize, okenn bonbon p ap itilize. Bibliyotèk la sipòte plizyè lang.

## Enstalasyon

### 1. Kopye depo a:

```bash
git clone https://github.com/webmonster97/cookie-consent.git
cd cookie-consent
```

### 2. Enstale depandans yo atravè Composer:

```bash
composer install
```

## Itilizasyon

### 1. Mete bibliyotèk la nan pwojè ou:

Asire w ke otoloadè Composer lan enkli nan dosye PHP prensipal ou.

```php
require __DIR__ . '/vendor/autoload.php';

use CookieConsent\CookieConsent;

// Mete lang default la nan 'fr'
$lang = 'fr';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre', 'mq'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();
```

### 2. Montre banyè konsantman an:

Rele metòd `renderConsentBanner()` pou montre banyè konsantman an sou paj ou.

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Egzanp Konsantman pou Bonbon</title>
</head>
<body>
    <h1>Byenveni sou sit nou an</h1>
    <p>Sit sa a sèvi ak bonbon pou amelyore eksperyans ou.</p>

    <?php
        $consent->renderConsentBanner();
    ?>
</body>
</html>
```

### 3. Ajoute script JavaScript la:

Asire w ke dosye JavaScript `consent.js` la chaje kòrèkteman nan paj ou.

```html
<script src="public/consent.js"></script>
```

## Konfigirasyon

Ou ka personnaliser banyè konsantman an lè w modifye estil yo atravè JavaScript epi chwazi lang mesaj la lè w pase yon paramèt nan URL la.

### 1. Dosye `consent.js` la:

Dosye sa a pèmèt personnalizasyon dinamik estil banyè a ak bouton yo.

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

        // Aplike estil banyè yo
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // Aplike estil bouton yo
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});
```

### 2. Personalizasyon atravè atribi `data-*`:

Ou ka personnaliser estil yo dirèkteman nan HTML lè w itilize atribi `data-*`.

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

### 3. Chwazi lang:

Itilizatè a ka chwazi lang mesaj konsantman an lè li ajoute yon paramèt `lang` nan URL la, pa egzanp:

```html
http://your-site.com/?lang=fr
```

Lang ki disponib yo se: `en` (Angle), `zh` (Chinwa), `hi` (Endi), `es` (Panyòl), `fr` (Franse), `cre` (Kreyòl), `mq` (Kreyòl Matinikè).

## Kredi

Bibliyotèk sa a te devlope pa Webmonster.tech. Li distribye anba lisans MIT. Pou plis enfòmasyon, tanpri vizite depo GitHub la https://github.com/webmonster97.