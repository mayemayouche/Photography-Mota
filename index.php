<?php get_header(); ?>

<div class="photohead">
    <div class="contenttitre">
        <img src="<?php echo get_stylesheet_directory_uri() . '/images/Titreheader.png'; ?>" class="titre" alt="titre prevent">
    </div>
</div>

<main>

<div class="lemenu">
    <form id="filter-form">
        <div class="conteneur-choix2">
            <div class="choix">
                <select name="categorie_filtre" id="categorie-filtre">
                    <option value="">Catégories</option>
                    <option value="mariage">Mariage</option>
                    <option value="reception">Réception</option>
                    <option value="television">Télévision</option>
                    <option value="concert">Concert</option>
                </select>
            </div>
			
			 
            <div class="choix">
                <select name="format_filtre" id="format-filtre">
                    <option value="">Formats</option>
                    <option value="paysage">Paysage</option>
                    <option value="portrait">Portrait</option>
                </select>
            </div>
			
   <div class="conteneur-choix3">
            <div class="choix">
                <select name="date_filtre" id="date-filtre">
                    <option value="">Trier par</option>
                    <option value="desc" id="filtres">Des plus récentes aux plus anciennes</option>
                    <option value="asc">Des plus anciennes aux plus récentes</option>
                </select>
            </div></div> </div></form></div>
            

<div class="lagalerie">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8, 
    );
    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) {
        echo '<div class="row">'; // Ouvrez la première ligne

        $index = 0; // Initialisez le compteur d'index ici

        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(500, 500));
            $title = get_the_title(); // Récupérer le titre
            $category = get_the_category()[0]->name;
            $reference = get_post_meta(get_the_ID(), 'reference', true); // Remplacez 'reference' par le nom réel de votre champ personnalisé
            $description = get_post_meta(get_the_ID(), 'description', true); // Ajoutez cette ligne

            echo '<div class="contenuphoto">' .
            $thumbnail .
            '<p class="description">' . $description . '</p>' .
            '<a href="' . get_permalink() . '" class="overlay-link">' .
            '<div class="overlay">' .
                '<div class="icone">' .
                    '<img src="' . get_template_directory_uri() . '/images/eye-svgrepo-com.svg" class="oeil" alt="icone oeil">' .
                '</div>' .
                '<div class="full-screen" data-fullimage="' . wp_get_attachment_image_url(get_post_thumbnail_id(), 'small') . '" data-reference="' . $reference . '" data-category="' . $category . '" data-index="' . $index . '">' .
                    '<img src="' . get_template_directory_uri() . '/images/Icon_fullscreen.svg" class="full" alt="plein ecran">' .
                '</div>' .
                '<div class="title-little">' .
                    '<h3 class="photo-title">' . $title . '</h3>' .
                '</div>' .
                '<div class="cat-little">' .
                    '<p class="photo-category">' . $category . '</p>' .
                '</div>' .
            '</div>'  .// Fin de overlay
            '</a>'  .// Fin de overlay-link
            '</div>'; // Fin de contenuphoto

            $index++; // Incrémentation du compteur d'index pour la prochaine image

            // Fermez la ligne actuelle et ouvrez une nouvelle après chaque deux photos
            if (($photos_query->current_post + 1) % 2 == 0 && $photos_query->current_post + 1 < $photos_query->post_count) {
                echo '</div><div class="row">';
            }
        }

        echo '</div>'; // Fermez la dernière ligne
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }
    ?>
</div>


    <div class="plus">
    <div class="charger">
<a id="charger-plus" class="charger" href="#">Charger plus</a></div>
    </div>

<!-- Lightbox container -->
<div id="lightbox-container" style="display: none;">

    <!-- Lightbox inner container -->
    <div id="lightbox-inner-container">
         <!-- Fermeture de la lightbox -->
         <span id="lightbox-close">&times;</span>

        <!-- Navigation left -->
        <div id="lightbox-nav-left" class="lightbox-nav"> <span class="ma-classe-icon">&#x2190;</span>Précédente</div>
        
        <!-- Image au milieu -->
        <img id="lightbox-image" src="" alt="Image en plein écran">
        
        <!-- Navigation right -->
        <div id="lightbox-nav-right" class="lightbox-nav">Suivante <span class="ma-classe-icon">&#x2192;</span></div>
    </div>
        <div id="lightbox-info">
        <div id="lightbox-reference"></div>
    <div id="lightbox-category"></div>

    </div>

    <!-- Informations supplémentaires : référence et catégorie -->
    
    </div>

</div>



</main>


<?php get_footer(); ?>
