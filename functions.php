<?php
/**
 * Pho2u functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pho2u
 */

if ( ! function_exists( 'pho2u_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pho2u_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pho2u, use a find and replace
		 * to change 'pho2u' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pho2u', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'pho2u' ),
			'menu-2' => esc_html__( 'Social Media Menu', 'pho2u' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pho2u_custom_background_args', array(
			'default-color' => '0f0f0f',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'pho2u_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pho2u_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pho2u_content_width', 640 );
}
add_action( 'after_setup_theme', 'pho2u_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pho2u_widgets_init() {
	register_sidebar ( array (
		'name'			=> __( 'Sitewide Footer (Site Width)', 'pho2u'),
		'id'			=> 'sidebar-sitewidth',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
	));

	register_sidebar ( array (
		'name'			=> __( 'Sitewide Footer (Full Width)', 'pho2u'),
		'id'			=> 'sidebar-fullwidth',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
	));
	register_sidebar ( array (
		'name'			=> __( 'Homepage Footer (Site Width)', 'pho2u'),
		'id'			=> 'sidebar-homesitewidth',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
	));

	register_sidebar ( array (
		'name'			=> __( 'Homepage Footer (Full Width)', 'pho2u'),
		'id'			=> 'sidebar-homefullwidth',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
	));

	register_sidebar ( array (
		'name'			=> __( 'Awards', 'pho2u'),
		'id'			=> 'sidebar-awards',
		'before_widget' => '<div id="%1$s" class="column %2$s">',
        'after_widget'  => '</div>'
	));
}
add_action( 'widgets_init', 'pho2u_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pho2u_scripts() {
	wp_enqueue_style( 'pho2u-style', get_stylesheet_uri() );

	// vendor scripts. only uncomment if you have files in assets/js/vendor 
	// wp_enqueue_script( 'pho2u-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), '20151215', true );

	// custom demo_theme_scripts
	// note that we pass 'customize-preview' into the array();
	wp_enqueue_script( 'pho2u-custom-scripts', get_template_directory_uri() . '/assets/js/custom.min.js', array('jquery', 'customize-preview'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pho2u_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

