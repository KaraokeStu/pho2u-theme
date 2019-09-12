<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

if ( ! is_active_sidebar( 'sidebar-fullwidth' ) ) {
	// return;
}
?>
<footer id="fullwidth">
	<?php dynamic_sidebar( 'sidebar-fullwidth' ); ?>
</footer>
