<?php get_header(); ?>

<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php while (have_posts()) : the_post(); ?>
            

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                    </header>

                    <div class="entry-content">
                        <div class="contenu">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            <div class="details">
                                <p>Référence : <?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
                                <p>Catégorie : <?php the_category(', '); ?></p>
                                <p>Format : <?php echo esc_html(get_post_meta(get_the_ID(), 'format', true)); ?></p>
                                <p>Type : <?php echo esc_html(get_post_meta(get_the_ID(), 'type', true)); ?></p>
                                <p>Année : <?php echo esc_html(get_post_meta(get_the_ID(), 'annee', true)); ?></p>
                            </div>
                        </div>
                        <div class="imagepost">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('thumbnail-custom', array('class' => 'custom-image'));
                            } ?>
                        </div>
                    </div>

                    <div class="middle">
                        <div class="plusplus">
                            <div>
                                <p class="plusphoto">Cette photo vous intéresse ?</p>
                            </div>
                            <div class="menu-contact">
                                <a id="test-button" class="bouton-link" href="#" data-reference="<?php echo esc_attr(get_post_meta(get_the_ID(), 'reference', true)); ?>">Contact</a>
                            </div></div>
                            <div class="popup-overlay" style="display: none">
                                <div class="popup-salon">
                                    <div class="popup-form">
                                        <img src="<?php echo get_template_directory_uri() . '/images/Contactheader.png'; ?>" class="imgForm">
                                        <span class="popup-close"></span>
                                    </div>
                               

                                    <?php
                                    // On insère le formulaire de demandes de renseignements
                                    echo do_shortcode('[contact-form-7 id="2a201c2" title="Formulaire de contact 1"]');
                                    ?>
                                </div>
                            </div>
                        



<!-- La petite galerie des posts -->
<div class="petitegalerie">    
        <div class="post-thumbnails">
        <?php
 // Récupère le post précédent et suivant
        $prev_post = get_previous_post();
        $next_post = get_next_post();

        // Affiche l'image miniature du post précédent
        if (!empty($prev_post)) {
        $prev_thumbnail = get_the_post_thumbnail($prev_post->ID, 'thumbnail');
        echo '<div class="prev-post-thumbnail">' . $prev_thumbnail . '</div>';
                            }


        // Affiche l'image miniature du post suivant
        if (!empty($next_post)) {
        $next_thumbnail = get_the_post_thumbnail($next_post->ID, 'thumbnail');
        echo '<div class="next-post-thumbnail">' . $next_thumbnail . '</div>';
                            }
?>
        </div>

        <div class="navigation-arrows">
        <div class="nav-arrow prev">
            <?php previous_post_link('%link', '<img src="' . get_template_directory_uri() . '/images/arrow-left-short.svg" class="flecheG" alt="fleche gauche">'); ?>
        </div>
        <div class="nav-arrow next">
            <?php next_post_link('%link', '<img src="' . get_template_directory_uri() . '/images/arrow-right-short.svg" class="flecheD" alt="fleche droite">'); ?>
        </div>
    </div>
</div></div>
                  



                    <!-- Chargement des photos de la même catégorie -->
                    <div class="aussi">
                        <h3>Vous aimerez aussi</h3>
                    </div>
                    <div class="galerieidem">
    <?php
    get_template_part('content', 'photos', array('posts_per_page' => 2));
    ?>
</div>


<div class="lebouton">
<div class="Toutes">   
    <a class="bouton-link" href="/">Toutes les photos</a>
    </div>
</div>
</article>
<?php endwhile; ?>
</main>
 

<?php get_footer(); ?>