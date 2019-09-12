<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

if ( ! is_active_sidebar( 'sidebar-awards' ) ) {
	// return;
}
?>
<div class="computer only row">
	<div class="twelve wide column">
		<div class="ui five column center aligned grid">
			<?php dynamic_sidebar( 'sidebar-awards' ); ?>
		</div>
	</div>
</div>
<div class="tablet only row">
	<div class="twelve wide column">
		<div class="ui four column center aligned grid">
			<?php dynamic_sidebar( 'sidebar-awards' ); ?>
		</div>
	</div>
</div>
<div class="mobile only row">
	<div class="sixteen wide column">
		<div class="ui three column center aligned grid">
			<?php dynamic_sidebar( 'sidebar-awards' ); ?>
		</div>
	</div>
</div>


