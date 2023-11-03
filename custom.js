jQuery(document).ready(function($) {
    $('.menu-contact').on('click', function(e) {
        e.preventDefault();

        jQuery(document).ready(function($) {
            jQuery(".full-screen[data-fullimage]").on("click", function() {
                var fullImage = jQuery(this).data("fullimage");
                var imageTitle = jQuery(this).siblings(".title-little").find(".photo-title").text();
    
                lightbox.open([{ src: fullImage, title: imageTitle }]);
    
                return false;
            });
        });

        // Récupérez la référence depuis les données localisées
        var reference = popup_data.ref;

        // Remplissez le champ du formulaire avec la référence
        $('#ref').val(reference);

        // Affichez le popup
        $('.popup-overlay').show();
    });
});
