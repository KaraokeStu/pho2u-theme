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
<nav id="mobilemenu">
	<div class="mobilelogo">
		<?php
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		?>
		<img src="<?php echo $image[0] ?>" alt="Pho2u! Logo" class="ui image fluid" />	
	</div>
	<nav id="menu">
		<div class="mobilelogo_scroll">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/pho2u_rectangular.png" alt="Pho2u! Logo" width="100" height="50" />
		</div>
		<label for="tm" id="toggle-menu"><h2>&#9776;</h2></label>
		<input type="checkbox" id="tm">
		<?php
		wp_nav_menu( array(
		'theme_location' => 'menu-1',
		'menu_id'        => 'responsive-menu',
		'container'		 => false
		) );
		?>
	</nav>
	
</nav>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pho2u' ); ?></a>
	
	<div id="fixedmenu" class="ui container custom-background">
		<header id="masthead" class="site-header ui container">
		<div class="ui padded grid">
			<div class="bottom aligned four wide mobile three wide tablet three wide computer column">
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
			<div class="twelve wide mobile thirteen wide tablet thirteen wide computer column">
				
						<nav id="social-navigation" class="ui text menu">
							<div class="right menu">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-2',
								'menu_id'        => 'social-media',
								'container'		 => false,
								'items_wrap'	 => '%3$s',
								'walker'		 => new pho2u_walker()
							) );
							?>
							</div>
						</nav>
					
						<nav id="site-navigation" class="ui inverted secondary pointing menu">
							<div class="right menu">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'		 => false,
								'items_wrap'	 => '%3$s',
								'walker'		 => new pho2u_walker()
							) );
							?>
							</div>
						</nav><!-- #site-navigation -->
					
				
			</div><!-- .twelve wide column -->
		</div>
		</header><!-- #masthead -->
	</div>
	<div id="featured">
		<?php 
		global $wp_query;
		$meta = get_post_meta( $post->ID, 'pho2u_fields', true );
		wp_reset_query();
		?>
		<div class="">
			<?php if ( get_header_image() ) : ?>
				<img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="ui fluid image">
			<?php else: ?>
				<video id="featured_video" loop muted autoplay preload="auto" poster="<?php echo get_template_directory_uri(); ?>/assets/img/pho2u.jpg" height="164" width="640">
					<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.mp4" type="video/mp4">
					<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.webm" type="video/webm">
					<source src="<?php echo get_template_directory_uri(); ?>/assets/video/pho2u.ogv" type="video/ogg">
					<img src=="<?php echo get_template_directory_uri(); ?>/assets/img/pho2u.png"/>
				</video>
			<?php endif; ?>
			<div id="featured_text" class="ui container">
				<h2 class="title"><?php the_title(); ?></h2>
				<?php  if (is_array($meta) && isset($meta['page_subtitle'])) : ?> 
				<h3 class="subtitle">{<?php echo $meta['page_subtitle']; ?>}</h3>
				<?php endif; ?>
				<?php  if (is_array($meta) && isset($meta['page_intro'])) : ?> 
				<div class="intro"><?php echo $meta['page_intro']; ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="content" class="site-content main ui container">
