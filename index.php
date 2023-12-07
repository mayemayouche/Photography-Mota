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
                <div class="dropdown">
                    <button class="dropdown-toggleC" type="button">
                        Catégories
                    </button>
                    <ul id="categorie-filtre-ul" class="dropdown-menu">
                        <li data-value="mariage">Mariage</li>
                        <li data-value="reception">Réception</li>
                        <li data-value="television">Télévision</li>
                        <li data-value="concert">Concert</li>
                    </ul>
            </div>
    </form>
</div>
       <div class="choix">
            <div class="dropdownf">
                    <button class="dropdown-toggleF" type="button">
                        Format </button>
                <ul id="format-filtre-ul" class="dropdown-menu">
                <li data-value="paysage">Paysage</li>
                <li data-value="portrait">Portrait</li>
</ul>
            </div></div>           
			
   <div class="conteneur-choix3">
            <div class="choix">
            <div class="dropdownd">
                    <button class="dropdown-toggleD" type="button">
                        Trier par </button>
                        <ul id="date-filtre-ul" class="dropdown-menu">
                    <li data-value="desc" id="filtres">Des plus récentes aux plus anciennes</li>
                    <li data-value="asc">Des plus anciennes aux plus récentes</li>
</ul>
            </div> </div> </div></div> </div></form></div>
            
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