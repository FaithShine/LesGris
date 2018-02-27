<?php
/**
 * plum functions and definitions
 *
 * @package plum
 */



if ( ! function_exists( 'plum_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function plum_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on plum, use a find and replace
	 * to change 'plum' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'plum', get_template_directory() . '/languages' );

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 global $content_width;
	 if ( ! isset( $content_width ) ) {
		$content_width = 740; /* pixels */
	 }
	 
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-logo', array(
		'height'      => 61,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'plum' ),
		/*'top' => __( 'Top Menu', 'plum' ), */
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 *
	 * Note: The theme declares support for HTML search form, but also uses its own implementation in searchform-top.php, which is loaded in header.php
	 *
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	
	add_image_size('plum-sq-thumb', 600,600, true );
	add_image_size('plum-thumb', 540,450, true );
	add_image_size('plum-pop-thumb',542, 340, true );
	
	//Declare woocommerce support
	add_theme_support('woocommerce');
	
	//Slider Support
	add_theme_support('rt-slider', array( 10 , 'pages', 'front-page-only') );
	
}
endif; // plum_setup
add_action( 'after_setup_theme', 'plum_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function plum_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'plum' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'plum' ), 
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'plum' ), 
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'plum' ), 
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
}
add_action( 'widgets_init', 'plum_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function plum_scripts() {
	wp_enqueue_style( 'plum-style', get_stylesheet_uri() );
	
	wp_enqueue_style('plum-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('plum_title_font', 'Lato') ).':100,300,400,700' );
	
	wp_enqueue_style('plum-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('plum_body_font', 'Open Sans') ).':100,300,400,700' );
	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'hover-style', get_template_directory_uri() . '/assets/css/hover.min.css' );

	wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/assets/css/slicknav.css' );
	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );
	
	wp_enqueue_style( 'plum-main-theme-style', get_template_directory_uri() . '/assets/css/'.get_theme_mod('plum_skin', 'default').'.css', array(), null );


	wp_enqueue_script( 'plum-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'plum-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'plum-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	
	// wp_register_style('leaflet', 'https://unpkg.com/leaflet@1.0.3/dist/leaflet.css', false, '1.0.3');
	// wp_enqueue_style('leaflet');

	


	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');
	wp_enqueue_script('jQuery');

	wp_register_script('chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js', false, '2.1.6');
	wp_enqueue_script('chartjs');

	

	wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js', false, '2.8.3');
	wp_enqueue_script('modernizr');



	wp_register_script('mapbox', 'https://api.mapbox.com/mapbox-gl-js/v0.36.0/mapbox-gl.js', false, '0.36.0');
	wp_enqueue_script('mapbox');

	wp_register_style('mapboxcss', 'https://api.mapbox.com/mapbox-gl-js/v0.36.0/mapbox-gl.css', false, '0.36.0');
	wp_enqueue_style('mapboxcss');

	wp_register_style('awesompletecss', 'https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.1/awesomplete.css', false, '1.1.1');
	wp_enqueue_style('awesompletecss');

	wp_register_script('awesomplete', 'https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.1/awesomplete.js', false, '1.1.1');
	wp_enqueue_script('awesomplete');



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'plum-custom-js', get_template_directory_uri() . '/js/custom.js', array('plum-externaljs') );
}
add_action( 'wp_enqueue_scripts', 'plum_scripts' );


//Backwards Compatibility FUnction
function plum_logo() {	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

function plum_has_logo() {
	if (function_exists( 'has_custom_logo')) {
		if ( has_custom_logo() ) {
			return true;
		}
	} else {
		return false;
	}
}

/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/framework/tgmpa.php';

