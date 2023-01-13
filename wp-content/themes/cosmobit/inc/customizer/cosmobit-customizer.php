<?php
/**
 * Cosmobit Customizer Class
 *
 * @package Cosmobit
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 if ( ! class_exists( 'Cosmobit_Customizer' ) ):

	class Cosmobit_Customizer {

		// Constructor customizer
		public function __construct() {
			
			add_action( 'customize_register',array( $this, 'cosmobit_customizer_register' ) );
			add_action( 'customize_register',array( $this, 'cosmobit_customizer_sainitization_selective_refresh' ) );
			add_action( 'customize_register',array( $this, 'cosmobit_customizer_control' ) );
			add_action( 'customize_preview_init',array( $this, 'cosmobit_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'cosmobit_customizer_navigation_script' ) );
			add_action( 'after_setup_theme',array( $this, 'cosmobit_customizer_settings' ) );
		}
		
		// Add postMessage support for site title and description for the Theme Customizer.
		public function cosmobit_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';
		}
		
		// Register custom controls
		public function cosmobit_customizer_control( $wp_customize ) {
			
			$cosmobit_control_dir =  COSMOBIT_THEME_INC_DIR . '/customizer/controls';
			// Load custom control classes.
			$wp_customize->register_control_type( 'Cosmobit_Customizer_Range_Control' );
			require $cosmobit_control_dir . '/code/cosmobit-slider-control.php';
			require $cosmobit_control_dir . '/code/editor/class/class-cosmobit-page-editor.php';

		}
		
		// selective refresh.
		public function cosmobit_customizer_sainitization_selective_refresh() {
			// Sanitization
			require COSMOBIT_THEME_INC_DIR . '/customizer/sanitization.php';
			// Selective Refresh
			require COSMOBIT_THEME_INC_DIR . '/customizer/cosmobit-selective-partial.php';
			require COSMOBIT_THEME_INC_DIR . '/customizer/cosmobit-selective-refresh.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function cosmobit_customize_preview_js() {
			wp_enqueue_script( 'cosmobit-customizer', COSMOBIT_THEME_INC_URI . '/customizer/assets/js/customizer.js', array( 'customize-preview' ), COSMOBIT_THEME_VERSION, true );
		}
		
		public function cosmobit_customizer_navigation_script() {
			 wp_enqueue_script( 'cosmobit-customizer-section', COSMOBIT_THEME_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}

		// Include customizer settings.
		public function cosmobit_customizer_settings() {
			$cosmobit_customize_dir =  COSMOBIT_THEME_INC_DIR . '/customizer/customizer-settings';
			
			// Recommended Plugin
			require COSMOBIT_THEME_INC_DIR . '/customizer/customizer-plugin-notice/cosmobit-notify-plugin.php';
			
			// Upsale
			require COSMOBIT_THEME_INC_DIR . '/customizer/controls/code/upgrade/class-customize.php';
			 
			// Header
			require $cosmobit_customize_dir . '/cosmobit-header-customize-setting.php';
			// Footer
			require $cosmobit_customize_dir . '/cosmobit-footer-customize-setting.php';
			// Theme Options
			require $cosmobit_customize_dir . '/cosmobit-theme-customize-setting.php';
			// Typography
			require $cosmobit_customize_dir . '/cosmobit-typography-customize-setting.php';
		}

	}
endif;
new Cosmobit_Customizer();