
<?php
                        $current_post_categories = get_the_category();

                        $category_ids = array();

                        foreach ($current_post_categories as $category) {
                            $category_ids[] = $category->term_id;
                        }

                        // Pour ne pas prendre le post en cours
                        $current_post_id = get_the_ID();

                        $posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : 2; // Valeur par défaut si non spécifié

                        $args = array(
                            'post_type' => 'photo',
                            'posts_per_page' => $posts_per_page, // Utilisez la variable $posts_per_page ici
                            'category__in' => $category_ids,
                            'post__not_in' => array($current_post_id)
                        );

                        $photos_query = new WP_Query($args);

                        if ($photos_query->have_posts()) {
                            echo '<div class="row">';

                            while ($photos_query->have_posts()) {
                                $photos_query->the_post();
                                $thumbnail = wp_get_attachment_image(get_post_thumbnail_id(), array(500, 500));
                                $title = get_the_title(); // Récupérer le titre
                                $category = get_the_category()[0]->name;
                                $reference = get_post_meta(get_the_ID(), 'reference', true); // Remplacez 'reference' par le nom réel de votre champ personnalisé
                                $description = get_post_meta(get_the_ID(), 'description', true); // Ajoutez cette ligne
                                echo '<div class="contenuphoto">' .
                                $thumbnail .
                                '<p class="description">' . $description . '</p>' .
                                '<a href="' . get_permalink() . '" class="overlay-link">' .
                                '<div class="overlay">' .
                                    '<div class="icone">' .
                                        '<img src="' . get_template_directory_uri() . '/images/eye-svgrepo-com.svg" class="oeil" alt="icone oeil">' .
                                    '</div>' .
                                    '<div class="full-screen" data-fullimage="' . wp_get_attachment_image_url(get_post_thumbnail_id(), 'small') . '" data-reference="' . $reference . '" data-category="' . $category . '">' .
                                        '<img src="' . get_template_directory_uri() . '/images/Icon_fullscreen.svg" class="full" alt="plein ecran">' .
                                    '</div>' .
                                    '<div class="title-little">' .
                                        '<h3 class="photo-title">' . $title . '</h3>' .
                                    '</div>' .
                                    '<div class="cat-little">' .
                                        '<p class="photo-category">' . $category . '</p>' .
                                    '</div>' .
                                '</div>'  .// Fin de overlay
                                '</a>'  .// Fin de overlay-link
                                '</div>'; // Fin de contenuphoto
                                if (($photos_query->current_post + 1) % 2 == 0 && $photos_query->current_post + 1 < $photos_query->post_count) {
                                    echo '</div><div class="row">';
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