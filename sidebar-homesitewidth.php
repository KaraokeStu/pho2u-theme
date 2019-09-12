<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

if ( ! is_active_sidebar( 'sidebar-homesitewidth' ) ) {
	// return;
}
?>
<footer id="homesitewidth" class="ui container">
	<?php dynamic_sidebar( 'sidebar-homesitewidth' ); ?>
</footer>
