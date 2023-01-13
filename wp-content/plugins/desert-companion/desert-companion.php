<?php
/**
* Plugin Name:       	Desert Companion
* Plugin URI:        	
* Description:       	Desert Companion Enhances Desert Themes with additional functionality.
* Version:           	1.0.14
* Author: 				Desertthemes
* Author URI: 			http://desertthemes.com/
* Tested up to: 		6.0
* Requires: 			4.6 or higher
* License: 				GPLv3 or later
* License URI: 			http://www.gnu.org/licenses/gpl-3.0.html
* Requires PHP: 		5.6
* Text Domain: 			desert-companion
*/

define( 'desert_companion_plugin_url', plugin_dir_url( __FILE__ ) );
define( 'desert_companion_plugin_dir', plugin_dir_path( __FILE__ ) );



if( !function_exists('desert_companion_init') ){
	function desert_companion_init(){
		require_once('inc/controls/code/desert-customize-upgrade-control.php');
		/**
		 * Get Activated Theme
		 */
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		// Cosmobit Theme
		if( 'Cosmobit' == $desert_activated_theme->name  || 'Cosmobit Child' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/cosmobit/cosmobit.php';
		}
		
		// Celexo Theme
		if( 'Celexo' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/celexo/celexo.php';
		}
		
		// Chitvi Theme
		if( 'Chitvi' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/chitvi/chitvi.php';
		}
		
		// Flexora Theme
		if( 'Flexora' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/flexora/flexora.php';
		}
		
		// Thinity Theme
		if( 'Thinity' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/thinity/thinity.php';
		}
		
		// EasyWiz Theme
		if( 'EasyWiz' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/easywiz/easywiz.php';
		}
		
		// LazyPress Theme
		if( 'LazyPress' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/lazypress/lazypress.php';
		}
	}
	add_action( 'init', 'desert_companion_init' );
}

/**
 * The code during plugin activation.
 */
function desert_companion_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/desert-companion-activator.php';
	Desert_Companion_Activator::activate();
}
register_activation_hook( __FILE__, 'desert_companion_activate' );