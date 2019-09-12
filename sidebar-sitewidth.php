<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

if ( ! is_active_sidebar( 'sidebar-sitewidth' ) ) {
	// return;
}
?>
<footer id="fullwidth" class="ui container">
	<?php dynamic_sidebar( 'sidebar-sitewidth' ); ?>
</footer>
