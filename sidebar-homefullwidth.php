<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

if ( ! is_active_sidebar( 'sidebar-homefullwidth' ) ) {
	// return;
}
?>
<footer id="homefullwidth">
	<?php dynamic_sidebar( 'sidebar-homefullwidth' ); ?>
</footer>
