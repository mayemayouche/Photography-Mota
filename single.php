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
                        <div class="plus">
                            <div>
                                <p class="plusphoto">Cette photo vous intéresse ?</p>
                            </div>
                            <div class="menu-contact">
                                <a id="popup-trigger" class="bouton-link" href="#" data-reference="<?php echo esc_attr(get_post_meta(get_the_ID(), 'reference', true)); ?>">Contact</a>
                        </div>
                    </div>

        <!-- La galerie -->
                    <?php
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => -1,
                    );
                    $photo_posts = new WP_Query($args);
                    ?>
                    <div class="navigation">
                            <?php
                            if ($photo_posts->have_posts()) :
                                while ($photo_posts->have_posts()) : $photo_posts->the_post();
                                    if (has_post_thumbnail()) {
                                        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                                        echo $thumbnail;
                                    }
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                    </div>
                </article>
            <?php endwhile; ?>

        <!-- Chargement des photos de la même catégorie -->
            <div class="aussi">
    <h3>Vous aimerez aussi</h3>
</div>
<div class="galerieidem">
    <?php
    $current_post_categories = get_the_category();

    $category_ids = array();

    foreach ($current_post_categories as $category) {
        $category_ids[] = $category->term_id;
    }

    // ne pas prendre ce post
    $current_post_id = get_the_ID();

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 2, 
        'category__in' => $category_ids, 
        'post__not_in' => array($current_post_id) 
    );

    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) {
        echo '<div class="row">'; 

        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(564, 500));
            echo '<div class="contenuphoto">' . $thumbnail . '</div>';
        }

        echo '</div>'; 
    }
    wp_reset_postdata();
    ?>
</div>

<!-- Chargement des photos -->
<div class="charger">
<a class="bouton-link" href="#">Toutes les photos</a>

</main>
    </div>
</div>

    <?php wp_footer(); ?>

</body>
</html>
