jQuery(document).ready(function($) {
    // Gestion du menu mobile
    $('.menu-burger-toggle').click(function() {
        $(this).toggleClass('open');
        $('.mobile-menu').toggle();
    });

jQuery(document).ready(function($) {
    // Lorsque l'utilisateur clique sur l'icône de plein écran
    $('.full-screen').on('click', function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du lien
        var fullImageSrc = $(this).data('fullimage'); // Obtenir l'URL de la grande image
        $('#lightbox-image').attr('src', fullImageSrc); // Définir l'URL comme source de l'image de la lightbox
        $('#lightbox-container').show(); // Afficher la lightbox
    });

    // Lorsque l'utilisateur clique sur le bouton de fermeture de la lightbox
    $('#lightbox-close').on('click', function() {
        $('#lightbox-container').hide(); // Cacher la lightbox
    });
});

    
jQuery(document).ready(function($) {
    var page = 1; // La page initiale est définie à 1

    $('#charger-plus').on('click', function(e) {
        e.preventDefault();
        var button = $(this);

        button.text('Chargement...'); // Indicateur visuel du chargement

        var data = {
            'action': 'charger_plus_photos',
            'page': page,
            'security': frontendajax.security
        };

        $.post(frontendajax.ajaxurl, data, function(response) {
            if (response) {
                // Créez un élément temporaire pour contenir la réponse
                var $temp = $('<div></div>').html(response);
                // Trouvez toutes les div .contenuphoto dans la réponse
                var $photos = $temp.find('.contenuphoto');
                
                // Insérer les photos par paires dans des divs .row
                var $row = $('<div class="row"></div>');
                $photos.each(function(index, photo) {
                    $row.append(photo);
                    // Après avoir ajouté deux photos ou à la fin, insérez la div .row et créez une nouvelle
                    if ((index + 1) % 2 === 0 || index + 1 === $photos.length) {
                        $('.plus').before($row);
                        $row = $('<div class="row"></div>'); // Créez une nouvelle div .row pour les prochaines photos
                    }
                });

                page++; // Incrémentez la variable de page pour charger les suivantes au prochain clic
                button.text('Charger plus'); // Réinitialiser le texte du bouton
            } else {
                button.text('Plus de photos à charger'); // Message si plus de photos
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('La requête AJAX a échoué', textStatus, errorThrown);
            button.text('Erreur de chargement');
        });
    });
});
});
jQuery(document).ready(function($) {
    // Gestionnaire de clic pour l'overlay, mais pas pour l'icône à l'intérieur
    $(document).on('click', '.overlay-link', function(event) {
        // Ici, le clic sur l'overlay entraînera la navigation vers le post.
        // Pas besoin de faire quoi que ce soit, le comportement par défaut du lien s'occupera de la navigation.
    });

    // Empêche le clic sur l'icône de la classe .full-screen de déclencher le lien parent
    $(document).on('click', '.full-screen', function(event) {
        event.preventDefault(); // Empêche le lien de s'activer
        event.stopPropagation(); // Empêche l'événement de remonter aux parents

        // Ici, vous pouvez ajouter votre logique pour afficher l'image en plein écran.
        // Par exemple, ouvrir une lightbox ou une nouvelle fenêtre avec l'image en plein écran.
        var fullImageUrl = $(this).data('fullimage');
        console.log('Ouvrir image en plein écran pour:', fullImageUrl);

        // Logique pour ouvrir l'image en plein écran ici
        // ...
    });

    // Si la div .icone doit également empêcher la navigation, ajoutez ceci
    $(document).on('click', '.icone', function(event) {
        event.preventDefault();
        event.stopPropagation();

        // Logique pour l'icône ici
        // ...
    });
});
jQuery(document).ready(function($) {
    var $navigation = $('.navigation');
    var $images = $navigation.find('.gallery-item');
    var currentIndex = 0; // Commencez par la première image

    // Cachez toutes les images sauf la première
    $images.hide().eq(currentIndex).show();

    // Affichez l'image précédente lorsque vous cliquez sur Précédent
    $('.nav-arrow.prev').click(function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : $images.length - 1;
        $images.hide().eq(currentIndex).show();
    });

    // Affichez l'image suivante lorsque vous cliquez sur Suivant
    $('.nav-arrow.next').click(function() {
        currentIndex = (currentIndex < $images.length - 1) ? currentIndex + 1 : 0;
        $images.hide().eq(currentIndex).show();
    });
});

//les filtres
jQuery(document).ready(function($) {
    $('#filter-form select').change(function() {
        var formData = $('#filter-form').serialize();
        console.log(formData); // Pour déboguer

        $.ajax({
            url: frontendajax.ajaxurl,
            type: 'POST',
            data: {
                'action': 'filter_photos_by_category', // Assurez-vous que c'est le nom correct de l'action
                'security': frontendajax.security,
                'formData': formData
            },
            success: function(response) {
                $('.lagalerie').html(response); // Met à jour la galerie avec la réponse
            }
        });
    });
});



