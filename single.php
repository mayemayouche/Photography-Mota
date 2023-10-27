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

                    <div class="plus">
                        <div>
                            <p class="plusphoto">Cette photo vous intéresse ?</p>
                        </div>
                        <div class="menu-contact">
                            <a id="popup-trigger" class="bouton-link" href="#" data-reference="<?php echo esc_attr(get_post_meta(get_the_ID(), 'reference', true)); ?>">Contact</a>
                        </div>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_image_link(false, $prev_label, count($images)); ?></div>
                        <div class="nav-next"><?php next_image_link(false, $next_label, count($images)); ?></div>
                    </div>

                <?php
                $images = get_posts(array(
                    'post_type' => 'photo', // Spécifiez le type de publication personnalisé "photo".
                    'posts_per_page' => -1, // Récupérez toutes les images liées aux articles "photo".
                    'post_status' => 'inherit', // Assurez-vous que vous obtenez uniquement les images liées aux articles "photo".
                    'post_mime_type' => 'image', // Assurez-vous que vous obtenez uniquement des images.
                ));
                

                if (!empty($images)) {
                    $next_label = esc_html__('Next Image', 'photography');
                    $prev_label = esc_html__('Previous Image', 'photography');
                ?>
                    

                    <div class="images-gallery">
                        <?php foreach ($images as $image) : ?>
                            <div class="image-item">
                                <?php echo wp_get_attachment_image($image->ID); // Affichez l'image 
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php
                }
                ?>

            <?php endwhile; ?>

        </main>
    </div>
</div>

<?php get_footer(); ?>