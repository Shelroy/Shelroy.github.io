<?php
/**
 * Cosmobit functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cosmobit
 */
 
if ( ! function_exists( 'cosmobit_theme_setup' ) ) :
function cosmobit_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cosmobit, use a find and replace
	 * to change 'Cosmobit' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cosmobit' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'cosmobit' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'cosmobit' ),
	) );
	
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// woocommerce support
	add_theme_support( 'woocommerce' );
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo');
	
	
	/**
	 * Custom background support.
	 */
	add_theme_support( 'custom-background', 
		apply_filters( 'cosmobit_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
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
	
	/**
	 * Set default content width.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 800;
	}
}
endif;
add_action( 'after_setup_theme', 'cosmobit_theme_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function cosmobit_widgets_init() {	

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Widget Area', 'cosmobit' ),
			'id' => 'cosmobit-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'cosmobit' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'cosmobit' ),
		'id' => 'cosmobit-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'cosmobit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title"><span></span>',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  1', 'cosmobit' ),
		'id' => 'cosmobit-footer-widget-1',
		'description' => __( 'The Footer Widget Area 1', 'cosmobit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  2', 'cosmobit' ),
		'id' => 'cosmobit-footer-widget-2',
		'description' => __( 'The Footer Widget Area 2', 'cosmobit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  3', 'cosmobit' ),
		'id' => 'cosmobit-footer-widget-3',
		'description' => __( 'The Footer Widget Area 3', 'cosmobit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  4', 'cosmobit' ),
		'id' => 'cosmobit-footer-widget-4',
		'description' => __( 'The Footer Widget Area 4', 'cosmobit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'cosmobit_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function cosmobit_scripts() {
	
	/**
	 * Styles.
	 */
	// Owl Crousel	
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/vendors/css/owl.carousel.min.css');
	
	// Font Awesome
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/vendors/css/font-awesome.min.css');
	
	// Animate
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/vendors/css/animate.css');

	// Cosmobit Core
	wp_enqueue_style('cosmobit-core',get_template_directory_uri().'/assets/css/core.css');

	// Cosmobit Theme
	wp_enqueue_style('cosmobit-theme', get_template_directory_uri() . '/assets/css/themes.css');
	
	// Cosmobit WooCommerce
	wp_enqueue_style('cosmobit-woocommerce',get_template_directory_uri().'/assets/css/woo-styles.css');
	
	// Cosmobit Style
	wp_enqueue_style( 'cosmobit-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );
	
	// Owl Crousel	
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/vendors/js/owl.carousel.min.js', array('jquery'), true);
	
	// Wow
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/vendors/js/wow.min.js', array('jquery'), false, true);
	
	// Cosmobit Theme
	wp_enqueue_script('cosmobit-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	// Cosmobit Custom
	wp_enqueue_script('cosmobit-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cosmobit_scripts' );



/**
 * Enqueue admin scripts and styles.
 */
function cosmobit_admin_enqueue_scripts(){
	wp_enqueue_style('cosmobit-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css');
	wp_enqueue_script( 'cosmobit-admin-script', get_template_directory_uri() . '/inc/admin/assets/js/cosmobit-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'cosmobit-admin-script', 'cosmobit_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'cosmobit_admin_enqueue_scripts' );


/**
 * Enqueue User Custom styles.
 */
if( ! function_exists( 'cosmobit_user_custom_style' ) ):
    function cosmobit_user_custom_style() {

		$cosmobit_print_style = '';
		
		 /*=========================================
		 Cosmobit Page Title
		=========================================*/	
		$cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_breadcrumb_height_option', '.dt__pagetitle', array( 'padding-top' ), array( 12, 12, 12 ), 'rem' );
		$cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_breadcrumb_height_option', '.dt__pagetitle', array( 'padding-bottom' ), array( 12, 12, 12 ), 'rem' );
		
		
		$cosmobit_breadcrumb_img_opacity 	= get_theme_mod('cosmobit_breadcrumb_img_opacity','0.9');
		$cosmobit_breadcrumb_opacity_color 	= get_theme_mod('cosmobit_breadcrumb_opacity_color','#0e2258e6');
		list($color1, $color2, $color3) = sscanf($cosmobit_breadcrumb_opacity_color, "#%02x%02x%02x");
			$cosmobit_print_style .=".dt__pagetitle:before {
					background-image: -moz-linear-gradient(0deg,var(--dt-sec-color) 0,rgba($color1, $color2, $color3, " .esc_attr($cosmobit_breadcrumb_img_opacity). ") 100%);
					background-image: -webkit-linear-gradient(0deg,var(--dt-sec-color) 0,rgba($color1, $color2, $color3, " .esc_attr($cosmobit_breadcrumb_img_opacity). ") 100%);
				}\n";
		
		 
		/*=========================================
		Logo Size 
		=========================================*/		
		$cosmobit_print_style   .= cosmobit_customizer_value( 'hdr_logo_size', '.site--logo img', array( 'max-width' ), array( 150, 150, 150 ), 'px !important' );
				
			
		/*=========================================
		Container
		=========================================*/		
		$cosmobit_site_container_width 			 = get_theme_mod('cosmobit_site_container_width','1252');
			if($cosmobit_site_container_width >=768 && $cosmobit_site_container_width <=2000){
				$cosmobit_print_style .=".dt-container {
						max-width: " .esc_attr($cosmobit_site_container_width). "px;
					}\n";
			}


		 /*=========================================
			Typography Body
		=========================================*/	
		 $cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_body_font_size_option', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_body_line_height_option', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_body_ltr_space_option', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );		 
		
		
		/*=========================================
			Typography Heading
		=========================================*/	
		 for ( $i = 1; $i <= 6; $i++ ) {
			 
			 $cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_h' . $i . '_font_size_option', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_h' . $i . '_line_height_option', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $cosmobit_print_style   .= cosmobit_customizer_value( 'cosmobit_h' . $i . '_ltr_space_option', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 }
		
        wp_add_inline_style( 'cosmobit-style', $cosmobit_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'cosmobit_user_custom_style' );
 
 
$cosmobit_theme = wp_get_theme();
define( 'COSMOBIT_THEME_VERSION', $cosmobit_theme->get( 'Version' ) );

// Root path/URI.
define( 'COSMOBIT_THEME_DIR', get_template_directory() );
define( 'COSMOBIT_THEME_URI', get_template_directory_uri() );

// Include path/URI.
define( 'COSMOBIT_THEME_INC_DIR', COSMOBIT_THEME_DIR . '/inc');
define( 'COSMOBIT_THEME_INC_URI', COSMOBIT_THEME_URI . '/inc');

/**
 * Implement the Custom Header feature.
 */
require COSMOBIT_THEME_INC_DIR . '/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once COSMOBIT_THEME_INC_DIR . '/template-tags.php';

/**
 * Customizer additions.
 */
 require COSMOBIT_THEME_INC_DIR . '/customizer/cosmobit-customizer.php';
 require COSMOBIT_THEME_INC_DIR . '/customizer/controls/code/customizer-repeater/inc/customizer.php';

/**
 * Nav Walker fo Bootstrap Dropdown Menu.
 */

require COSMOBIT_THEME_INC_DIR . '/class-wp-bootstrap-navwalker.php';

/**
 * Control Style
 */

require COSMOBIT_THEME_INC_DIR . '/customizer/controls/code/control-function/style-functions.php';


/**
 * Getting Started
 */
require COSMOBIT_THEME_INC_DIR . '/admin/getting-started.php';