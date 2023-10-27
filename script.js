jQuery(document).ready(function($) {
    // Gérer le clic sur le bouton du menu burger
    $('.menu-burger-toggle').click(function() {
        $('.mobile-menu').toggle(); // Afficher/masquer le menu mobile
    });
});
jQuery(document).ready(function($) {
    $('#filter-form select').change(function() {
        var category = $('#category-filter').val();
        var format = $('#format-filter').val();
        var sortOrder = $('#sort-order').val();

        // Effectuez une requête AJAX pour récupérer les images en fonction des filtres
        $.ajax({
            url: 'votre-url-de-traitement.php', // Remplacez par l'URL de votre script PHP de traitement
            type: 'POST',
            data: {
                category: category,
                format: format,
                sortOrder: sortOrder
            },
            success: function(data) {
                // Remplacez le contenu du conteneur de la galerie par les nouvelles images
                $('#gallery-container').html(data);
            }
        });
    });
});

jQuery(document).ready(function($) {
    $(".custom-image").each(function() {
        $(this).css({
            "max-width": "600px",  // Personnalisez la largeur comme vous le souhaitez
            "height": "auto"  // Assure le maintien du ratio hauteur/largeur
        });
    });
});

