
<footer class="site__footer">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
	</footer>

	<?php wp_footer(); ?>

<?php get_template_part( 'contact' ); ?>


<!-- Lightbox container -->
<div id="lightbox-container" style="display: none;">

    <!-- Lightbox inner container -->
    <div id="lightbox-inner-container">
         <!-- Fermeture de la lightbox -->
         <span id="lightbox-close">&times;</span>

        <!-- Navigation left -->
        <div id="lightbox-nav-left" class="lightbox-nav"> <span class="ma-classe-icon">&#x2190;</span>Précédente</div>
        
        <!-- Image au milieu -->
        <img id="lightbox-image" src="" alt="Image en plein écran">
        
        <!-- Navigation right -->
        <div id="lightbox-nav-right" class="lightbox-nav">Suivante <span class="ma-classe-icon">&#x2192;</span></div>
    </div>
        <div id="lightbox-info">
        <div id="lightbox-reference"></div>
    <div id="lightbox-category"></div>

    </div>