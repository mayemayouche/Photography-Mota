<script src="<?php echo get_stylesheet_directory_uri(); ?>/script.js"></script>

<footer class="site__footer">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
	</footer>

	<?php wp_footer(); ?>

<?php get_template_part( 'contact' ); ?>