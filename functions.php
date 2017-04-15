<?php
/**
 * WCMS Base Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WCMS_Base_Theme
 */

require "sass/typography/fonts.php";
require "inc/wp-bootstrap-navwalker.php";

if ( ! function_exists( 'wcms_base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */


function wcms_base_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WCMS Base Theme, use a find and replace
	 * to change 'wcms-base' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wcms-base', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'wcms-base' ),
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
	add_theme_support( 'custom-background', apply_filters( 'wcms_base_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'wcms_base_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wcms_base_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wcms_base_content_width', 640 );
}
add_action( 'after_setup_theme', 'wcms_base_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wcms_base_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wcms-base' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wcms-base' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wcms_base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wcms_base_scripts() {
	wp_enqueue_style( 'wcms-base-style', get_stylesheet_uri() );


//Deregistering the Jquery scripts from WordPress and loading a new one!
	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/inc/jquery-3.2.0/jquery-3.2.0.min.js', array(), '3.2.0', true );

//Loading Tether
	wp_enqueue_script('tether', get_template_directory_uri() . '/inc/tether/tether.min.js', array('jquery'), '', true);

//Loading Bootstrap scripts but the "jquery" and the "tether" files must be loaded before this.
	wp_enqueue_script( 'bootstrap4', get_template_directory_uri() . '/inc/bootstrap-4.0.0-alpha.6/dist/js/bootstrap.min.js', array('jquery', 'tether'), '4.0.0-alpha.6', true );

	if (is_singular() && comments_open() && get_option('tread_comments')){
		wp_enqueue_script('comment-reply');
	}
}

add_action( 'wp_enqueue_scripts', 'wcms_base_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php'; //man kan gå genom utseende och anpassa på WP

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//Adding "theme-support" for my "serch-form" is going to be "nicer"
add_theme_support('HTML5', array('search-form'));

//Addin a filter to avoid "bad words" ;-)
function filter_profanity( $content ) {
	$profanities = array('badword','alsobad','...');
	$content = str_ireplace( $profanities, '{censored}', $content );
	return $content;
}