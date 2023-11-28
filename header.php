<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300&family=Space+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300&family=Poppins:wght@300&family=Space+Mono:ital,wght@0,400;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>
<div class="en-tete">
    <header class="site-header">
        <a href="/">
            <img src="<?php echo get_template_directory_uri() . '/images/Logo1.png'; ?>" class="logo" alt="logo photographe">
        </a>

        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'main',
                'container' => 'false',  
                'menu_class' => 'headermenu', 
            )
        );
        ?>
        </div>
<!-- Code du bouton Contact et du Popup -->

<div class="popup-overlay" style="display: none">
    <div class="popup-salon">
        <div class="popup-form">
            <img src="<?php echo get_template_directory_uri() . '/images/Contactheader.png'; ?>" class="imgForm">
            <span class="popup-close"></span>
        </div>

        <?php echo do_shortcode('[contact-form-7 id="2a201c2" title="Formulaire de contact 1"]'); ?>
    </div>
</div>


        <!-- Menu burger -->
        <div class="menu-burger-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <!-- Menu mobile  -->
        <div class="mobile-menu">
            <ul class="choices">
                <li>
                <a href="http://photography-mota.local" aria-current="page" class="mobile-item">Accueil</a>  
                </li>
                <li>
                <a href="http://photography-mota.local/a-propos/" class="mobile-item">À propos</a>
                </li>
                <li><a id="popup-trigger" class="mobile-item">Contact</a></li>
            </ul>
        </div>
        
        
    </header>