<?php get_header(); ?>
<div class="photohead">
    <div class="contenttitre">
        <img src="<?php echo get_stylesheet_directory_uri() . '/images/Titreheader.png'; ?>" class="titre" alt="titre prevent">
    </div>
</div>
<main>
    <div class="lemenu">
    <div class="conteneur-choix2">
        <div class="choix">
        <form id="filter-form">
        <select id="categorie-filtre">
        <option value="">Catégories</option>
        <option value="mariage">Mariage</option>
        <option value="reception">Réception</option>
        <option value="television">Télévision</option>
    </select></div>
        <div class="choix">
        <select id="categorie-filtre">
        <option value="">Formats</option>
        <option value="paysage">Paysage</option>
        <option value="portrait">Portrait</option>
        </select></div></div>
        <div class="conteneur-choix3">
        <div class="choix">
    <select id="categorie-filtre">
        <option value="desc">Trier par</option>
        <option value="desc">Des plus récentes aux plus anciennes</option>
         <option value="asc">Des plus anciennes aux plus récentes</option>
    </select></div>
    </form>
    </div>
    
    </div>
    <div class="lagalerie">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8, // Afficher toutes les photos
    );
    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) {
        echo '<div class="row">'; // Ouvrez la première ligne

        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(500, 500));

            echo
'<div class="contenuphoto">
    ' . $thumbnail . '
    <p class="description">' . get_the_excerpt() . '</p>
    <div class="overlay">
    <div class="icone">
        <img src="' . get_template_directory_uri() . '/images/eye-svgrepo-com.svg" class="oeil" alt="icone oeil">
        </div>
        <div class="title-little">
            <h3 class="photo-title">' . get_the_title() . '</h3>
        </div>
        <div class="cat-little">
            <p class="photo-category">' . get_the_category()[0]->name . '</p>
        </div>
    </div>
</div>';


            // Ajoutez une condition pour fermer la ligne après chaque deux photos.
            if ($photos_query->current_post % 2 === 1) {
                echo '</div><div class="row">'; // Fermez la ligne précédente et ouvrez une nouvelle ligne.
            }
        }

        echo '</div>'; // Fermez la dernière ligne
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }
    ?>
</div>
</div>
      

    </main>
</div>

<?php get_footer(); ?>
