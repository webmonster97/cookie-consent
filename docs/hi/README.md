# कुकी सहमति प्रबंधन लाइब्रेरी प्रलेखन

## विवरण

यह PHP लाइब्रेरी GDPR नियमों के अनुसार कुकी सहमति का प्रबंधन करती है। जब कोई उपयोगकर्ता किसी पृष्ठ पर आता है, तो एक कुकी सहमति संदेश प्रदर्शित होता है। उपयोगकर्ता कुकीज़ के उपयोग को स्वीकार या अस्वीकार कर सकता है। यदि उपयोगकर्ता स्वीकार करता है, तो संदेश बाद के दौरे पर प्रदर्शित नहीं होगा। यदि उपयोगकर्ता अस्वीकार करता है, तो कोई कु

Voici la documentation en hindi au format Markdown.

# कुकी सहमति प्रबंधन लाइब्रेरी प्रलेखन

## विवरण

यह PHP लाइब्रेरी GDPR नियमों के अनुसार कुकी सहमति का प्रबंधन करती है। जब कोई उपयोगकर्ता किसी पृष्ठ पर आता है, तो एक कुकी सहमति संदेश प्रदर्शित होता है। उपयोगकर्ता कुकीज़ के उपयोग को स्वीकार या अस्वीकार कर सकता है। यदि उपयोगकर्ता स्वीकार करता है, तो संदेश बाद के दौरे पर प्रदर्शित नहीं होगा। यदि उपयोगकर्ता अस्वीकार करता है, तो कोई कुकीज़ का उपयोग नहीं किया जाएगा। लाइब्रेरी कई भाषाओं का समर्थन करती है।

## स्थापना

### 1. रिपॉजिटरी को क्लोन करें:

```bash
git clone https://github.com/webmonster97/cookie-consent.git
cd cookie-consent
```

### 2. Composer के माध्यम से निर्भरताएँ स्थापित करें:

```bash
composer install
```

## उपयोग

### 1. अपने प्रोजेक्ट में लाइब्रेरी को शामिल करें:

सुनिश्चित करें कि आपके मुख्य PHP फ़ाइल में Composer ऑटोलोडर शामिल है।

```php
require __DIR__ . '/vendor/autoload.php';

use CookieConsent\CookieConsent;

// डिफ़ॉल्ट भाषा को 'fr' पर सेट करें
$lang = 'fr';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre', 'mq'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();
```

### 2. कुकी सहमति बैनर प्रदर्शित करें:

अपने पृष्ठ पर कुकी सहमति बैनर प्रदर्शित करने के लिए `renderConsentBanner()` विधि को कॉल करें।

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>कुकी सहमति उदाहरण</title>
</head>
<body>
    <h1>हमारी साइट पर आपका स्वागत है</h1>
    <p>यह साइट आपके अनुभव को बढ़ाने के लिए कुकीज़ का उपयोग करती है।</p>

    <?php
        $consent->renderConsentBanner();
    ?>
</body>
</html>
```

### 3. जावास्क्रिप्ट स्क्रिप्ट जोड़ें:

सुनिश्चित करें कि `consent.js` जावास्क्रिप्ट फ़ाइल आपके पृष्ठ पर सही ढंग से लोड हो रही है।

```html
<script src="public/consent.js"></script>
```

## कॉन्फ़िगरेशन

आप जावास्क्रिप्ट के माध्यम से शैलियों को संशोधित करके कुकी सहमति बैनर को अनुकूलित कर सकते हैं और URL में एक पैरामीटर पास करके संदेश की भाषा चुन सकते हैं।

### 1. `consent.js` फ़ाइल:

यह फ़ाइल बैनर और बटन शैलियों के गतिशील अनुकूलन की अनुमति देती है।

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

        // बैनर शैलियों को लागू करें
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // बटन शैलियों को लागू करें
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});
```

### 2. `data-*` विशेषताओं के माध्यम से अनुकूलन:

आप `data-*` विशेषताओं का उपयोग करके सीधे HTML में शैलियों को अनुकूलित कर सकते हैं।

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

### 3. भाषा का चयन:

उपयोगकर्ता URL में `lang` पैरामीटर जोड़कर सहमति संदेश की भाषा चुन सकता है, उदाहरण के लिए:

```html
http://your-site.com/?lang=fr
```

उपलब्ध भाषाएँ हैं: `en` (अंग्रेज़ी), `zh` (चीनी), `hi` (हिंदी), `es` (स्पेनिश), `fr` (फ्रेंच), `cre` (क्रियोल), `mq` (मार्टिनिकन क्रियोल)।

## क्रेडिट

इस लाइब्रेरी को Webmonster.tech द्वारा विकसित किया गया है। यह MIT लाइसेंस के तहत वितरित की जाती है। अधिक जानकारी के लिए, कृपया GitHub रिपॉजिटरी https://github.com/webmonster97 पर जाएँ।