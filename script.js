    // Gestion du menu mobile
    jQuery(document).ready(function($) {
        $('.menu-burger-toggle').click(function() {
            $(this).toggleClass('open');
            $('.mobile-menu').toggle();
        });
        });
    
        jQuery(document).ready(function($) {
            $('#test-button').on('click', function() {
                console.log('Test button clicked');
    
                var reference = $(this).data('reference');
    
            // Remplit le champ du formulaire avec la référence, si le champ existe
            if ($('#ref').length) {
                $('#ref').val(reference);
            }
                $('.popup-overlay').show();
            });
    
            $('.popup-overlay').on('click', function() {
                $('.popup-overlay').hide();
            });
        
        $('.popup-close').click(function() {
            $('.popup-overlay').hide();
        });
        });   
    
        // La Lighbox
    jQuery(document).ready(function($) {
        $('.full').on('click', function(e) { // on click sur l'icône de plein écran full
            e.preventDefault(); // On empêche le comportement par défaut du lien
            var fullImageSrc = $(this).data('fullimage'); // URL de la grande image
            $('#lightbox-image').attr('src', fullImageSrc); // URL devient source de l'image de la lightbox
            $('#lightbox-container').show(); 
        });
    
        // click sur le bouton de fermeture de la lightbox
        $('#lightbox-close').on('click', function() {
            $('#lightbox-container').hide(); 
        });
    });
    
    //RECUPERATION DONNES DANS LIGHTBOX 
    jQuery(document).ready(function($) {
        var currentImageIndex;
        var totalImages = $('.full-screen').length;
    
        $('.full-screen').on('click', function() {
            currentImageIndex = $(this).data('index');
            updateLightbox($(this));
    
            // Afficher la lightbox
            $('#lightbox-container').show();
        });
    
        $('#lightbox-nav-left').on('click', function() {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                updateLightbox($('.full-screen').eq(currentImageIndex));
            }
        });
    
        $('#lightbox-nav-right').on('click', function() {
            console.log("Clic sur Suivant détecté");
            console.log("Index actuel avant incrementation: ", currentImageIndex);
            if (currentImageIndex < totalImages - 1) {
                currentImageIndex++;
                updateLightbox($('.full-screen').eq(currentImageIndex));
            }
        });
    
        // Gestionnaire pour fermer la lightbox
        $('#lightbox-close').on('click', function() {
            $('#lightbox-container').hide();
        });
    
        function updateLightbox(element) {
            var fullImageUrl = element.data('fullimage');
            var category = element.data('category');
            var reference = element.data('reference');
    
            // Mettre à jour la source de l'image et les informations dans la lightbox
            $('#lightbox-image').attr('src', fullImageUrl);
            $('#lightbox-reference').text(reference);
            $('#lightbox-category').text(category);
        }
    });
    
    
    
        //GALERIE ACCUEIL - CHARGER PLUS
        jQuery(document).ready(function($) {
        var page = 1; // La page initiale est définie à 1
    
        $('#charger-plus').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
    
            button.text('Chargement en cours...'); //Pour mettre un message sur le bouton
    
            var data = {
                'action': 'charger_plus_photos',
                'page': page,
                'security': frontendajax.security
            };
    
            $.post(frontendajax.ajaxurl, data, function(response) {
                if (response) {
                    // sert à verifier si il y a une reponse du serveur et s'il y a des donnés
                    var $temp = $('<div></div>').html(response);
                    // si reponse oui au if, alors une div est créée avec le contenu de la réponse
                    // on va chercher tous les elements ayant cette classe
                    var $photos = $temp.find('.contenuphoto');
                    
                    // Mise en page des photos dans les divs .row
                    var $row = $('<div class="row"></div>');
                    $photos.each(function(index, photo) {
                        $row.append(photo);
                        // Après avoir ajouté deux photos on insére la div .row et on crée une nouvelle
                        if ((index + 1) % 2 === 0 || index + 1 === $photos.length) {
                            // $('.plus').before($row);
                            // $row.insertAfter('.galerie .row');
                            $('.lagalerie .row').last().after($row);
                            $row = $('<div class="row"></div>'); // Nouvelle div .row pour les prochaines photos
                        }
                    });
    
                    page++; // click suivant pour charger d'autres photos
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
    
    
    //GESTION DE L'OVERLAY ET DE SES ELEMENTS//
    
    jQuery(document).ready(function($) {
        $(document).on('click', '.overlay-link', function(event) {
            // Ici, le clic sur l'overlay entraînera la navigation vers le post.
            // Pas besoin de faire quoi que ce soit, le comportement par défaut du lien s'occupera de la navigation.
        });
    
        // Empêche le clic sur l'icône de la classe .full-screen de déclencher le lien parent
        $(document).on('click', '.full-screen', function(event) {
            event.preventDefault(); // Empêche le lien de s'activer
            event.stopPropagation(); // Empêche l'événement de remonter aux parents
    
            
            var fullImageUrl = $(this).data('fullimage');
            console.log('Ouvrir image en plein écran pour:', fullImageUrl);
    
            
        });
    
        // Si la div .icone doit également empêcher la navigation, ajoutez ceci
        $(document).on('click', '.icone', function(event) {
            event.preventDefault();
            event.stopPropagation();
    
        });
    });
    
    //GESTION DES FILTRES SUR LES MENUS DEROULANTS
    jQuery(document).ready(function($) {
        $('#filter-form select').change(function() { //recupere les elements ayant cet id
            var formData = $('#filter-form').serialize();//recupere les champs d'un formulaire
            //et les convertit en chaine de requete (format+titre par exemple).c'est une methode JQuery
    
            $.ajax({
                url: frontendajax.ajaxurl,
                type: 'POST',
                data: {
                    'action': 'filter_photos_by_category', //action defini dans ma pas function -add action
                    'security': frontendajax.security,
                    'formData': formData
                },
                success: function(response) {
                    $('.lagalerie').html(response); // Met à jour la galerie avec la réponse
                }
            });
        });
    });
    
    
    //GALERIE MINI DE LA PAGE SINGLE//
    jQuery(document).ready(function($) {
        var $navigation = $('.navigation');
        var $images = $navigation.find('.gallery-item');
        var currentIndex = 0; // on prend la 1ère image
        // on cache les autres
        $images.hide().eq(currentIndex).show();
    
        // Affiche l'image précédente au click
        $('.nav-arrow.prev').click(function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : $images.length - 1;
            $images.hide().eq(currentIndex).show();
        });
    
        // Affiche l'image suivante au click
        $('.nav-arrow.next').click(function() {
            currentIndex = (currentIndex < $images.length - 1) ? currentIndex + 1 : 0;
            $images.hide().eq(currentIndex).show();
        });
    });
    
    jQuery(document).ready(function($) {
        $('.contactformulaire').click(function(e) {
            e.preventDefault();
            $('.popup-overlay').show();
        });
    
        $('.popup-close').click(function() {
            $('.popup-overlay').hide();
        });
    });
    
        
        
        
        