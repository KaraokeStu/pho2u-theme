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

	<footer id="colophon" class="site-footer">
		<div class="ui center aligned grid container">
			<div class="mobile only row">
					<nav id="social-navigation-footer" class="social-navigation">
						<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'social-media',
									'container'		 => false,
									'items_wrap'	 => '%3$s',
									'walker'		 => new pho2u_walker()
								) );
								?>
					</nav>
			</div>
			<?php get_sidebar( 'awards' ); ?>
		</div>
	</footer><!-- #colophon -->
	<?php
		if ( is_front_page() && is_home() ) :
			get_sidebar( 'fullwidth' );
			get_sidebar( 'sitewidth' );
		else :
			get_sidebar( 'homefullwidth' );
			get_sidebar( 'homesitewidth' );
		endif;
	?>
	<footer id="branding" class="site-footer ui container">
		<div class="ui center aligned grid">
			<div class="twelve wide column">&copy; <?php echo date("Y"); ?> - Site Design by <a href="https://fdsoftware.co.uk" target="_blank">FD Software</a></div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
