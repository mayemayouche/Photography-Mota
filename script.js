jQuery(document).ready(function($) {
    // Gestion du menu mobile
    $('.menu-burger-toggle').click(function() {
        $(this).toggleClass('open');
        $('.mobile-menu').toggle();
    });


        // Ouvrir la lightbox au clic sur l'icône "plein écran"
        $('.full-screen').click(function(e) {
            e.preventDefault();
            var fullImage = $(this).data('fullimage');
            console.log("Lien vers l'image en taille réelle : " + fullImage);
    
            // Mettez à jour le contenu de la lightbox avec l'image en taille réelle
            $('#custom-lightbox img').attr('src', fullImage);
            console.log("Chemin de l'image mise à jour : " + $('#custom-lightbox img').attr('src'));
            console.log("Élément image de la lightbox : " + $('#custom-lightbox img').length);
            console.log("Lien vers l'image en taille réelle : " + fullImage);
            // Affichez la lightbox
            $('#custom-lightbox').fadeIn();
            console.log("Lightbox affichée.");
        });
    
        // Fermer la lightbox au clic sur le bouton "Fermer"
        $('#close-lightbox').click(function() {
            $('#custom-lightbox').fadeOut();
        });
    });
    
