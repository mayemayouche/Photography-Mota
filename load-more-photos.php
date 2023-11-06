<?php
require_once('../../wp-load.php');
if(isset($_POST['offset'])) {
    $offset = intval($_POST['offset']);
}
else{
    $offset = 0;
}

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
    
        echo '<div class="contenuphoto">
            ' . $thumbnail . '
            <p class="description">' . get_the_excerpt() . '</p>
            <div class="overlay">
                <div class="icone">
                    <img src="' . get_template_directory_uri() . '/images/eye-svgrepo-com.svg" class="oeil" alt="icone oeil">
                </div>
                <div class="full-screen" data-fullimage="' . wp_get_attachment_image_url(get_post_thumbnail_id(), 'small') . '">
                    <img src="' . get_template_directory_uri() . '/images/Icon_fullscreen.svg" class="full" alt="plein ecran">
                </div>
                <div class="title-little">
                    <h3 class="photo-title">' . get_the_title() . '</h3>
                </div>
                <div class="cat-little">
                    <p class="photo-category">' . get_the_category()[0]->name . '</p>
                </div>
            </div>
        </div>';
    }}