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
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function(event) { 
			var canvas = document.getElementById('featured_video_cropped'),
			ctx = canvas.getContext('2d');
			function loop(){
				var video = document.getElementById('featured_video');
				ctx.drawImage(video, 0,50, 640, 360, 0, 0, 640, 360);
				setTimeout(loop, 1000 / 30);
			}
    
			loop();
			}
		);
	</script>
</head>

<body <?php body_class(); ?> onload="javascript:onLoadEvent()">
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
	<div id="featured">
		<div class="ui container">
		<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="ui fluid image">
			<div id="featured_text">
				<?php the_title(); ?>
			</div>
			</div>
		<?php else: ?>
			<canvas id="featured_video_cropped" width="640" height="260"></canvas>
			<video id="featured_video" loop muted autoplay preload="auto" poster="<?php echo get_template_directory_uri(); ?>/assets/img/pho2u.png" height="360" width="640">
				<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.webm" type="video/webm">
				<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.mp4" type="video/mp4">
				<img src=="<?php echo get_template_directory_uri(); ?>/assets/img/pho2u.png"/>
			</video>
			<div id="featured_text">
				<h2 class="title"><?php the_title(); ?></h2>
			</div>
		<?php endif; ?>
		</div>
	</div>
	<div id="content" class="site-content ui main container">
