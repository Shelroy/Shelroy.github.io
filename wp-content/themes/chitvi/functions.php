<?php
/**
 * Theme functions and definitions
 *
 * @package Chitvi
 */

/**
 * After setup theme hook
 */
function chitvi_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'chitvi' );	
}
add_action( 'after_setup_theme', 'chitvi_theme_setup' );

/**
 * Load assets.
 */

function chitvi_theme_css() {
	wp_enqueue_style( 'chitvi-parent-theme-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('chitvi-child-theme-style', get_stylesheet_directory_uri() . '/style.css');	
}
add_action( 'wp_enqueue_scripts', 'chitvi_theme_css', 99);

require get_stylesheet_directory() . '/theme-functions/controls/class-customize.php';

/**
 * Import Options From Parent Theme
 *
 */
function chitvi_parent_theme_options() {
	$cosmobit_mods = get_option( 'theme_mods_cosmobit' );
	if ( ! empty( $cosmobit_mods ) ) {
		foreach ( $cosmobit_mods as $cosmobit_mod_k => $cosmobit_mod_v ) {
			set_theme_mod( $cosmobit_mod_k, $cosmobit_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'chitvi_parent_theme_options' );