document.addEventListener("DOMContentLoaded", function() {
    const consentBanner = document.getElementById('consent-banner');
    const consentMessage = document.getElementById('consent-message');
    const consentButtons = consentBanner.querySelectorAll('button');

    if (consentBanner) {
        // Personnalisation de la bannière de consentement
        const bannerStyles = {
            backgroundColor: '#000',  // Couleur de fond par défaut
            color: '#fff',            // Couleur du texte par défaut
            fontFamily: 'Arial, sans-serif',  // Police par défaut
        };

        // Appliquer les styles par défaut de la bannière
        Object.keys(bannerStyles).forEach(style => {
            consentBanner.style[style] = bannerStyles[style];
        });

        // Appliquer les styles personnalisés de la bannière
        Object.keys(userConfig.banner).forEach(style => {
            consentBanner.style[style] = userConfig.banner[style];
        });

        // Appliquer les styles personnalisés des boutons
        consentButtons.forEach(button => {
            Object.keys(userConfig.buttons).forEach(style => {
                button.style[style] = userConfig.buttons[style];
            });
        });
    }
});