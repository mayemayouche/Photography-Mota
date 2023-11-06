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
            
            // Affichez la lightbox
            $('#custom-lightbox').fadeIn();
            console.log("Lightbox affichée.");
        });
    
        // Fermer la lightbox au clic sur le bouton "Fermer"
        $('#close-lightbox').click(function() {
            $('#custom-lightbox').fadeOut();
        });
    });
    jQuery(document).ready(function($) {
        var page = 2; // La page à charger (2 pour la deuxième page, 3 pour la troisième, etc.)
        var canLoad = true; // Pour empêcher le chargement répété
        
        $('#load-more-photos').click(function(e) {
            e.preventDefault();
            
            if (!canLoad) {
                return;
            }
        
            canLoad = false;
        
            var data = {
                action: 'load_more_photos',
                page: page,
            };
        
            $.ajax({
                url: custom_script_params.ajaxurl,
                data: data,
                type: 'POST',
                success: function(response) {
                    if (response) {
                        $('#additional-photos-container.new-rows').append(response); // Ajoutez les nouvelles photos aux nouvelles lignes
                        page++;
                        canLoad = true;
                    } else {
                        $('#load-more-photos').hide(); // Plus de photos à charger
                    }
                }
            });
        });
    });
    
    
    
    