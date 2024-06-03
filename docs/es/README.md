# Documentación de la biblioteca de gestión del consentimiento de cookies

## Descripción

Esta biblioteca PHP gestiona el consentimiento de cookies de acuerdo con las regulaciones GDPR. Cuando un usuario llega a una página, se muestra un mensaje de consentimiento de cookies. El usuario puede aceptar o rechazar el uso de cookies. Si el usuario acepta, el mensaje ya no se mostrará en visitas posteriores. Si el usuario rechaza, no se utilizarán cookies. La biblioteca admite varios idiomas.

## Instalación

### 1. Clonar el repositorio:

```bash
git clone https://github.com/webmonster97/cookie-consent.git
cd cookie-consent
```

### 2. Instalar dependencias vía Composer:

```bash
composer install
```

## Uso

### 1. Incluir la biblioteca en tu proyecto:

Asegúrate de que el autoloader de Composer esté incluido en tu archivo PHP principal.

```php
require __DIR__ . '/vendor/autoload.php';

use CookieConsent\CookieConsent;

// Establecer el idioma predeterminado a 'fr'
$lang = 'fr';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre', 'mq'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();
```

### 2. Mostrar el banner de consentimiento:

Llama al método `renderConsentBanner()` para mostrar el banner de consentimiento en tu página.

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo de Consentimiento de Cookies</title>
</head>
<body>
    <h1>Bienvenido a nuestro sitio</h1>
    <p>Este sitio utiliza cookies para mejorar tu experiencia.</p>

    <?php
        $consent->renderConsentBanner();
    ?>
</body>
</html>
```

### 3. Agregar el script JavaScript:

Asegúrate de que el archivo JavaScript `consent.js` se cargue correctamente en tu página.

```html
<script src="public/consent.js"></script>
```

## Configuración

Puedes personalizar el banner de consentimiento modificando los estilos vía JavaScript y elegir el idioma del mensaje pasando un parámetro en la URL.

### 1. Archivo `consent.js`:

Este archivo permite la personalización dinámica de los estilos del banner y de los botones.

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

        // Aplicar estilos del banner
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // Aplicar estilos de los botones
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});
```

### 2. Personalización mediante atributos `data-*`:

Puedes personalizar los estilos directamente en HTML utilizando atributos `data-*`.

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

### 3. Elección del idioma:

El usuario puede elegir el idioma del mensaje de consentimiento agregando un parámetro `lang` en la URL, por ejemplo:

```html
http://tu-sitio.com/?lang=fr
```

Los idiomas disponibles son: `en` (Inglés), `zh` (Chino), `hi` (Hindi), `es` (Español), `fr` (Francés), `cre` (Criollo), `mq` (Criollo martiniqués).

## Créditos

Esta biblioteca fue desarrollada por Webmonster.tech. Se distribuye bajo la Licencia MIT. Para más información, visita el repositorio en GitHub https://github.com/webmonster97.