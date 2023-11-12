<?php
add_theme_support('post-thumbnails');

function enqueue_theme_assets() {
    wp_enqueue_style('PhotographyMota-style', get_stylesheet_uri());
    
    // Enqueue jQuery from Google CDN
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true);
    
    // Enqueue custom script
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0', true);
    
    // Localize script for AJAX
    wp_localize_script('custom-script', 'frontendajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('charger_plus_photos'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');

// Function for AJAX load more photos
function charger_plus_photos() {
    

    // Get current page number and increase by 1
    $page = $_POST['page'] + 1;
    
    // Define the query arguments
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
    );

    // Create new WP_Query
    $photos_query = new WP_Query($args);
    
    if ($photos_query->have_posts()) {
        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            if (has_post_thumbnail()) {
                $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(564, 500));
                    $title = get_the_title();
                    $category = get_the_category()[0]->name;
                    $description = get_the_excerpt();
    
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
        }
    }
}
wp_die(); // Terminez la requête AJAX
                }

// Add AJAX actions for logged in and non-logged in users
add_action('wp_ajax_charger_plus_photos', 'charger_plus_photos');
add_action('wp_ajax_nopriv_charger_plus_photos', 'charger_plus_photos');


//filtres ajax
add_action('wp_ajax_filter_photos_by_category', 'filter_photos_by_category_function');
add_action('wp_ajax_nopriv_filter_photos_by_category', 'filter_photos_by_category_function');
function filter_photos_by_category_function() {
    // Vérification de la sécurité
    check_ajax_referer('charger_plus_photos', 'security');

    parse_str($_POST['formData'], $formData);
    $category_filter = $formData['categorie_filtre'];
    $format_filter = $formData['format_filtre'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
    );

    // Filtre par catégorie
    if (!empty($category_filter)) {
        $args['category_name'] = $category_filter;
    }

    // Filtre par format (champ personnalisé)
    if (!empty($format_filter)) {
        $args['meta_query'] = array(
            array(
                'key' => 'format',
                'value' => $format_filter,
                'compare' => '='
            )
        );
    }
    $date_filter = $formData['date_filtre'];
    if (!empty($date_filter)) {
        $args['orderby'] = 'date';
        $args['order'] = $date_filter; // 'ASC' ou 'DESC'
    }
    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) {
        echo '<div class="row">'; 

        while ($photos_query->have_posts()) {
            $photos_query->the_post();
                if (has_post_thumbnail()) {
                $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(564, 500));
                    $title = get_the_title();
                    $category = get_the_category()[0]->name;
                    $description = get_the_excerpt();
    
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
    if ($photos_query->current_post % 2 === 1 && !$photos_query->is_last()) {
        echo '</div><div class="row">'; 
    }
}
        }
echo '</div>'; // Fermez la dernière ligne après la boucle
} else {
echo 'Pas de photos trouvées.';
}
wp_die(); // Termine la requête AJAX correctement
}
?>

