<?php
function cosmobit_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'cosmobit'),
		) 
	);
	
	/*=========================================
	Cosmobit Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','cosmobit'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Logo Width // 
	if ( class_exists( 'Cosmobit_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_logo_size',
			array(
				'default'			=> '150',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'cosmobit_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Cosmobit_Customizer_Range_Control( $wp_customize, 'hdr_logo_size', 
			array(
				'label'      => __( 'Logo Size', 'cosmobit' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'cosmobit_hdr_nav',
        array(
        	'priority'      => 4,
            'title' 		=> __('Navigation Bar','cosmobit'),
			'panel'  		=> 'header_options',
		)
    );
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'cosmobit_hdr_cart'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_cart',
		array(
			'type' => 'hidden',
			'label' => __('WooCommerce Cart','cosmobit'),
			'section' => 'cosmobit_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'cosmobit' ),
			'section'     => 'cosmobit_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'cosmobit_hdr_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_search',
		array(
			'type' => 'hidden',
			'label' => __('Site Search','cosmobit'),
			'section' => 'cosmobit_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'cosmobit' ),
			'section'     => 'cosmobit_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'cosmobit_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','cosmobit'),
			'section' => 'cosmobit_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'cosmobit' ),
			'section'     => 'cosmobit_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	// Button Label // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_btn_lbl',
    	array(
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','cosmobit'),
		    'section' 		=> 'cosmobit_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_btn_link',
    	array(
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','cosmobit'),
		    'section' 		=> 'cosmobit_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'cosmobit_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'cosmobit' ),
			'section'     => 'cosmobit_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'cosmobit_sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sticky','cosmobit'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'cosmobit_hdr_sticky'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_sticky',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','cosmobit'),
			'section' => 'cosmobit_sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'cosmobit' ),
			'section'     => 'cosmobit_sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'cosmobit_header_customize_settings' );

