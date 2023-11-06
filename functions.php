<?php
add_theme_support('post-thumbnails');

function enqueue_theme_assets() {
    wp_enqueue_style('PhotographyMota-style', get_stylesheet_uri());
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true);
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0', true);
    wp_localize_script('script', 'frontendajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');
add_action('wp_enqueue_scripts', 'enqueue_custom_script');

function load_more_photos() {
    $page = $_POST['page'];
    $current_post_id = get_the_ID();
    
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'post__not_in' => array($current_post_id),
        'paged' => $page
    );

    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) {
        $additional_photos = '';

        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(564, 500));
            $additional_photos .= '<div class="contenuphoto new-rows">' . $thumbnail . '</div>';
        }

        wp_reset_postdata();

        echo $additional_photos;
    }

    die();
}





add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


//add_action('after_setup_theme', 'custom_image_sizes');

function custom_image_class($content) {
    return str_replace('<img', '<img class="custom-image"', $content);
}
add_filter('the_content', 'custom_image_class');

//function custom_image_sizes() {
    // Définissez une nouvelle taille d'image en utilisant add_image_size
    // 'full-size-1025' est le nom de la taille, vous pouvez le personnaliser
   // add_image_size('full-size-1025', 1025, 0, true);

    // Ajoutez ce format à l'ensemble des images disponibles
   // add_filter('image_size_names_choose', 'custom_image_size_names');
//}

//function custom_image_size_names($sizes) {
  //  $new_sizes = array_merge($sizes, array(
   //     'full-size-1025' => __('Full Size (1025px)'),
  //  ));
 //   return $new_sizes;
//}

// AJAX
add_action('wp_ajax_load_more_photos', 'load_more_photos_function');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos_function');

function get_additional_images($offset) {
    $args = array(
        'post_type' => 'post', 
        'posts_per_page' => 8, 
        'offset' => $offset, 
    );

    $query = new WP_Query($args);

    return $query->posts;
}

function load_more_photos_function() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    
    $additional_images = get_additional_images($offset);
    
    $html = '';

    foreach ($additional_images as $image) {
        $html .= '<div class="image"><img src="' . get_the_post_thumbnail_url($image) . '"></div>';
    }

    echo $html;

    wp_die();
}
function localize_custom_script() {
    wp_localize_script('custom-script', 'custom_script_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'localize_custom_script');


?>
