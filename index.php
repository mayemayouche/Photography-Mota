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
                </select>
            </div>
            <div class="choix">
                <select name="format_filtre" id="format-filtre">
                    <option value="">Formats</option>
                    <option value="paysage">Paysage</option>
                    <option value="portrait">Portrait</option>
                </select>
            </div>
        </div>
        <div class="conteneur-choix3">
            <div class="choix">
                <select name="date_filtre" id="date-filtre">
                    <option value="">Trier par</option>
                    <option value="desc">Des plus récentes aux plus anciennes</option>
                    <option value="asc">Des plus anciennes aux plus récentes</option>
                </select>
            </div>
        </div>
    </form>
</div>

    



    <div class="lagalerie">
        <?php
             $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8, 
             );
             $photos_query = new WP_Query($args);

             if ($photos_query->have_posts()) {
            echo '<div class="row">'; 

            while ($photos_query->have_posts()) {
                $photos_query->the_post();
                $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(500, 500));
            
                echo '<div class="contenuphoto">' .
                $thumbnail .
                '<p class="description">' . $description . '</p>' .
                '<a href="' . get_permalink() . '" class="overlay-link">' .
                '<div class="overlay">' .
                    '<div class="icone">' .
                        '<img src="' . get_template_directory_uri() . '/images/eye-svgrepo-com.svg" class="oeil" alt="icone oeil">' .
                    '</div>' .
                    '<div class="full-screen" data-fullimage="' . wp_get_attachment_image_url(get_post_thumbnail_id(), 'small') . '">' .
                        '<img src="' . get_template_directory_uri() . '/images/Icon_fullscreen.svg" class="full" alt="plein ecran">' .
                    '</div>' .
                    '<div class="title-little">' .
                        '<h3 class="photo-title">' . $title . '</h3>' .
                    '</div>' .
                    '<div class="cat-little">' .
                        '<p class="photo-category">' . $category . '</p>' .
                    '</div>' .
                '</div>' . // Fin de .overlay
                '</a>' . // Fin de .overlay-link
                '</div>'; // Fin de .contenuphoto
                
            
            
    
    
    // 2 photos par ligne
    if ($photos_query->current_post % 2 === 1) {
        echo '</div><div class="row">'; 
    }
}
       }
        ?>
    </div>

    <div class="plus">
    <div class="charger">
<a id="charger-plus" class="charger" href="#">Charger plus</a></div>
    </div>

<!-- Lightbox container -->
<div id="lightbox-container" style="display: none;">
    <div id="lightbox-content">
        <div id="lightbox-nav-left" class="lightbox-nav">&lt;</div>
        <img id="lightbox-image" src="" alt="Image en plein écran">
        <div id="lightbox-nav-right" class="lightbox-nav">&gt;</div>
    </div>
        <div id="lightbox-title">Titre de l'image</div>
        <span id="lightbox-close">&times;</span>
    </div>
</div>



</main>


<?php get_footer(); ?>
