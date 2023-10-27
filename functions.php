<?php
// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

function PhotographyMota_add_admin_pages() {
    add_menu_page(
        'Paramètres du thème PhotographyMota',
        'PhotographyMota',
        'manage_options',
        'PhotographyMota-settings',
        'PhotographyMota_theme_settings',
        'dashicons-admin-settings',
        60
    );
}

function PhotographyMota_theme_settings() {
    echo '<h1>' . get_admin_page_title() . '</h1>';
}

add_action('admin_menu', 'PhotographyMota_add_admin_pages', 10);

function enqueue_theme_styles() {
    wp_enqueue_style('PhotographyMota-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

function enqueue_theme_scripts() {
    // Enregistrez jQuery depuis la bibliothèque CDN de Google
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true);
}

add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');

function ajouter_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/script.js', array('jquery'), null, true);
    wp_enqueue_script('custom', get_template_directory_uri() . '/custom.js', array('jquery'), null, true);

    wp_localize_script('custom', 'popup_data', array(
        'ref' => esc_attr(get_post_meta(get_the_ID(), 'reference', true))
    ));

}
add_action('wp_enqueue_scripts', 'ajouter_scripts');

function ajouter_element_personnalise_menu($items, $args) {
    if ($args->theme_location == 'main') {
        $items .= '<li><a id="popup-trigger" href="#">Contact</a></li>';
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'ajouter_element_personnalise_menu', 10, 2);

register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

