<?php
function cosmobit_theme_options_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'cosmobit_theme_options', array(
			'priority' => 31,
			'title' => esc_html__( 'Theme Options', 'cosmobit' ),
		)
	);
	
	/*=========================================
	General Options
	=========================================*/
	$wp_customize->add_section(
		'site_general_options', array(
			'title' => esc_html__( 'General Options', 'cosmobit' ),
			'priority' => 1,
			'panel' => 'cosmobit_theme_options',
		)
	);
	
	/*=========================================
	Site Preloader
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'cosmobit_preloader_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_preloader_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Preloader','cosmobit'),
			'section' => 'site_general_options',
		)
	);
	
	
	// Hide/ Show
	$wp_customize->add_setting( 
		'cosmobit_hs_preloader_option' , 
			array(
			'default' => '',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_preloader_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'cosmobit' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Scroller
	=========================================*/
	
	// Heading
	$wp_customize->add_setting(
		'cosmobit_scroller_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cosmobit_scroller_option',
		array(
			'type' => 'hidden',
			'label' => __('Top Scroller','cosmobit'),
			'section' => 'site_general_options',
		)
	);
	
	// Hide/show
	$wp_customize->add_setting( 
		'cosmobit_hs_scroller_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_scroller_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'cosmobit' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Cosmobit Container
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'cosmobit_site_container_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'cosmobit_site_container_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Container','cosmobit'),
			'section' => 'site_general_options',
		)
	);
	
	if ( class_exists( 'Cosmobit_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'cosmobit_site_container_width',
			array(
				'default'			=> '1252',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'cosmobit_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'      => 6,
			)
		);
		$wp_customize->add_control( 
		new Cosmobit_Customizer_Range_Control( $wp_customize, 'cosmobit_site_container_width', 
			array(
				'label'      => __( 'Container Width', 'cosmobit' ),
				'section'  => 'site_general_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 768,
                        'max'           => 2000,
                        'step'          => 1,
                        'default_value' => 1252,
                    ),
                ),
			) ) 
		);
	}
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'cosmobit_site_breadcrumb', array(
			'title' => esc_html__( 'Site Breadcrumb', 'cosmobit' ),
			'priority' => 12,
			'panel' => 'cosmobit_theme_options',
		)
	);
	
	// Heading
	$wp_customize->add_setting(
		'cosmobit_site_breadcrumb_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_site_breadcrumb_option',
		array(
			'type' => 'hidden',
			'label' => __('Settings','cosmobit'),
			'section' => 'cosmobit_site_breadcrumb',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'cosmobit_hs_site_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_site_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'cosmobit' ),
			'section'     => 'cosmobit_site_breadcrumb',
			'type'        => 'checkbox'
		) 
	);
	
	// Breadcrumb Content Section // 
	$wp_customize->add_setting(
		'cosmobit_site_breadcrumb_content'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'cosmobit_site_breadcrumb_content',
		array(
			'type' => 'hidden',
			'label' => __('Content','cosmobit'),
			'section' => 'cosmobit_site_breadcrumb',
		)
	);
	
	// Height // 
	$wp_customize->add_setting(
    	'cosmobit_breadcrumb_height_option',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority' => 8,
		)
	);
	$wp_customize->add_control( 
		new Cosmobit_Customizer_Range_Control( $wp_customize, 'cosmobit_breadcrumb_height_option', 
			array(
				'label'      => __( 'Top/Bottom Padding', 'cosmobit'),
				'section'  => 'cosmobit_site_breadcrumb',
				'media_query'   => true,
				'input_attr'    => array(
					'mobile'  => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 12,
					),
					'tablet'  => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 12,
					),
					'desktop' => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 12,
					),
				),
			) ) 
		);
		
	// Background // 
	$wp_customize->add_setting(
		'cosmobit_breadcrumb_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'cosmobit_breadcrumb_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Background','cosmobit'),
			'section' => 'cosmobit_site_breadcrumb',
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'cosmobit_breadcrumb_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/pagetitle_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cosmobit_breadcrumb_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'cosmobit'),
			'section'        => 'cosmobit_site_breadcrumb',
		) 
	));
	
	// Opacity // 
	if ( class_exists( 'Cosmobit_Customizer_Range_Control' ) ) {
	$wp_customize->add_setting(
    	'cosmobit_breadcrumb_img_opacity',
    	array(
	        'default'			=> '0.9',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_range_value',
			'priority'  => 11,
		)
	);
	$wp_customize->add_control( 
	new Cosmobit_Customizer_Range_Control( $wp_customize, 'cosmobit_breadcrumb_img_opacity', 
		array(
			'label'      => __( 'Opacity', 'cosmobit'),
			'section'  => 'cosmobit_site_breadcrumb',
			 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 1,
                        'step'          => 0.1,
                        'default_value' => 0.9,
                    ),
                ),
		) ) 
	);
	}
	
	$wp_customize->add_setting(
	'cosmobit_breadcrumb_opacity_color', 
	array(
		'default' => '#0e2258e6',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'  => 12,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'cosmobit_breadcrumb_opacity_color', 
			array(
				'label'      => __( 'Opacity Color', 'cosmobit'),
				'section'    => 'cosmobit_site_breadcrumb',
			) 
		) 
	);
	
	
	/*========================================
	Cosmobit Sidebar
	=========================================*/
	$wp_customize->add_section(
        'cosmobit_sidebar_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Sidebar Options','cosmobit'),
			'panel'  		=> 'cosmobit_theme_options',
		)
    );
	
	//  Pages Layout // 
	$wp_customize->add_setting(
		'cosmobit_pages_sidebar_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_pages_sidebar_option',
		array(
			'type' => 'hidden',
			'label' => __('Sidebar Layout','cosmobit'),
			'section' => 'cosmobit_sidebar_options',
		)
	);
	
	// Default Page
	$wp_customize->add_setting( 
		'cosmobit_default_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_select',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'cosmobit_default_pg_sidebar_option' , 
		array(
			'label'          => __( 'Default Page Sidebar Option', 'cosmobit' ),
			'section'        => 'cosmobit_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'cosmobit' ),
				'right_sidebar' 	=> __( 'Right Sidebar', 'cosmobit' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'cosmobit' ),
			) 
		) 
	);
	
	// Archive Page
	$wp_customize->add_setting( 
		'cosmobit_archive_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_select',
			'priority' => 3,
		) 
	);

	$wp_customize->add_control(
	'cosmobit_archive_pg_sidebar_option' , 
		array(
			'label'          => __( 'Archive Page Sidebar Option', 'cosmobit' ),
			'section'        => 'cosmobit_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'cosmobit' ),
				'right_sidebar' => __( 'Right Sidebar', 'cosmobit' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'cosmobit' ),
			) 
		) 
	);
	
	
	// Single Page
	$wp_customize->add_setting( 
		'cosmobit_single_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'cosmobit_single_pg_sidebar_option' , 
		array(
			'label'          => __( 'Single Page Sidebar Option', 'cosmobit' ),
			'section'        => 'cosmobit_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'cosmobit' ),
				'right_sidebar' => __( 'Right Sidebar', 'cosmobit' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'cosmobit' ),
			) 
		) 
	);
	
	
	// Blog Page
	$wp_customize->add_setting( 
		'cosmobit_blog_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'cosmobit_blog_pg_sidebar_option' , 
		array(
			'label'          => __( 'Blog Page Sidebar Option', 'cosmobit' ),
			'section'        => 'cosmobit_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'cosmobit' ),
				'right_sidebar' => __( 'Right Sidebar', 'cosmobit' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'cosmobit' ),
			) 
		) 
	);
	
	// Search Page
	$wp_customize->add_setting( 
		'cosmobit_search_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'cosmobit_search_pg_sidebar_option' , 
		array(
			'label'          => __( 'Search Page Sidebar Option', 'cosmobit' ),
			'section'        => 'cosmobit_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'cosmobit' ),
				'right_sidebar' => __( 'Right Sidebar', 'cosmobit' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'cosmobit' ),
			) 
		) 
	);
	
	
	// WooCommerce Page
	$wp_customize->add_setting( 
		'cosmobit_shop_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'cosmobit_shop_pg_sidebar_option' , 
		array(
			'label'          => __( 'WooCommerce Page Sidebar Option', 'cosmobit' ),
			'section'        => 'cosmobit_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'cosmobit' ),
				'right_sidebar' => __( 'Right Sidebar', 'cosmobit' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'cosmobit' ),
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'cosmobit_sidebar_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 7,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'cosmobit_sidebar_option_upsale', 
				array(
					'label'      => __( 'Sidebar Features', 'cosmobit' ),
					'section'    => 'cosmobit_sidebar_options'
				) 
			) 
		);	
	}
}
add_action( 'customize_register', 'cosmobit_theme_options_customize' );
