<?php get_header(); ?>

<div class="photohead">
    <div class="contenttitre">
        <img src="<?php echo get_stylesheet_directory_uri() . '/images/Titreheader.png'; ?>" class="titre" alt="titre prevent">
    </div>
</div>

<main>

<div class="lemenu">
    <form id="filter-form">
        <div class="conteneur-choix2">
            <div class="choix">
                <select name="categorie_filtre" id="categorie-filtre">
                    <option value="">Catégories</option>
                    <option value="mariage">Mariage</option>
                    <option value="reception">Réception</option>
                    <option value="television">Télévision</option>
                    <option value="concert">Concert</option>
                </select>
            </div>
			
			 
            <div class="choix">
                <select name="format_filtre" id="format-filtre">
                    <option value="">Formats</option>
                    <option value="paysage">Paysage</option>
                    <option value="portrait">Portrait</option>
                </select>
            </div>
			
   <div class="conteneur-choix3">
            <div class="choix">
                <select name="date_filtre" id="date-filtre">
                    <option value="">Trier par</option>
                    <option value="desc" id="filtres">Des plus récentes aux plus anciennes</option>
                    <option value="asc">Des plus anciennes aux plus récentes</option>
                </select>
            </div></div> </div></form></div>
            
<div class="conteneur-galerie">
<div class="lagalerie">
    <?php
    
    get_template_part('content', 'photos', array('posts_per_page' => 8));
    ?>
</div>


    <div class="plus">
    <div class="charger">
<a id="charger-plus" class="charger" href="#">Charger plus</a></div>
    </div>


    <!-- Informations supplémentaires : référence et catégorie -->
    
    </div>

</div>



</main>


<?php get_footer(); ?>