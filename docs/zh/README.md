# Cookie 同意管理库文档

## 描述

此 PHP 库根据 GDPR 规定管理 Cookie 同意。当用户访问页面时，会显示一个 Cookie 同意消息。用户可以接受或拒绝使用 Cookie。如果用户接受，同意消息在后续访问中将不再显示。如果用户拒绝，则不使用任何 Cookie。该库支持多种语言。

## 安装

### 1. 克隆存储库:

```bash
git clone https://github.com/webmonster97/cookie-consent.git
cd cookie-consent
```

### 2. 通过 Composer 安装依赖项:

```bash
composer install
```

## 使用

### 1. 在项目中包含库:

确保在主 PHP 文件中包含 Composer 自动加载器。

```php
require __DIR__ . '/vendor/autoload.php';

use CookieConsent\CookieConsent;

// 将默认语言设置为 'fr'
$lang = 'fr';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'zh', 'hi', 'es', 'fr', 'cre', 'mq'])) {
    $lang = $_GET['lang'];
}

$consent = new CookieConsent($lang);
$consent->handleConsent();
```

### 2. 显示同意横幅:

调用 `renderConsentBanner()` 方法在页面上显示同意横幅。

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cookie 同意示例</title>
</head>
<body>
    <h1>欢迎访问我们的网站</h1>
    <p>本网站使用 Cookie 以提升您的体验。</p>

    <?php
        $consent->renderConsentBanner();
    ?>
</body>
</html>
```

### 3. 添加 JavaScript 脚本:

确保 `consent.js` JavaScript 文件在页面中正确加载。

```html
<script src="public/consent.js"></script>
```

## 配置

您可以通过修改 JavaScript 中的样式自定义同意横幅，并通过在 URL 中传递参数选择消息的语言。

### 1. `consent.js` 文件:

该文件允许动态定制横幅和按钮样式。

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

        // 应用横幅样式
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // 应用按钮样式
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});
```

### 2. 通过 `data-*` 属性自定义:

您可以直接在 HTML 中使用 `data-*` 属性自定义样式。

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

### 3. 选择语言:

用户可以通过在 URL 中添加 `lang` 参数选择同意消息的语言，例如:

```html
http://your-site.com/?lang=fr
```

可用语言包括: `en` (英语), `zh` (中文), `hi` (印地语), `es` (西班牙语), `fr` (法语), `cre` (克里奥尔语), `mq` (马提尼克克里奥尔语)。

## 致谢

此库由 Webmonster.tech 开发。它根据 MIT 许可证分发。欲了解更多信息，请访问 GitHub 存储库 https://github.com/webmonster97。

---

这里是完整的中文文档。