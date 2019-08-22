<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pho2u
 */

?>


<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pho2u' ); ?></a>
	<div id="fixedmenu" class="custom-background">
		<header id="masthead" class="site-header ui container grid">
			<div class="four wide column padded bottom aligned">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$pho2u_description = get_bloginfo( 'description', 'display' );
					if ( $pho2u_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $pho2u_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
			</div><!-- .four wide column -->
			<div class="twelve wide middle aligned column">
				<div class="ui grid">
					<div class="right floated computer sixteen wide computer tablet only column">
						<nav id="social-navigation" class="social-navigation">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-2',
								'menu_id'        => 'social-media',
							) );
							?>
						</nav>
					</div>
					<div class="right floated sixteen wide column">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'pho2u' ); ?></button>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div><!-- .twelve wide column -->
		</header><!-- #masthead -->
	</div>
	<div id="featured" class="site-content ui main container">
	<?php if ( get_header_image() ) : ?>
		<div id="site-header ui container">
			<img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="ui fluid image">
		</div>
	<?php else: ?>
		<div id="site-header ui container">
			<video loop muted autoplay poster="<?php echo get_template_directory_uri(); ?>/assets/img/pho2u.png" class="promo-video">
				<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.webm" type="video/webm">
				<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.mp4" type="video/mp4">
			</video>
		</div>
	<?php endif; ?>
	</div>
	<div id="content" class="site-content ui main container">
