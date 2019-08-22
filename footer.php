<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer ui container grid">
		<div class="sixteen wide mobile only right floated column">
				<nav id="social-navigation" class="social-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'social-media',
					) );
					?>
				</nav>
		</div>
		<div class="sixteen wide center aligned column">&copy; <?php echo date("Y"); ?> - Site Design by <a href="https://fdsoftware.co.uk" target="_blank">FD Software</a></div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
