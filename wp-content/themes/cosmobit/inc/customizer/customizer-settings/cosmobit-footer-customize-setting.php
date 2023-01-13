<?php
function cosmobit_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'cosmobit'),
		) 
	);

	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'cosmobit_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','cosmobit'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'cosmobit_footer_copyright_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cosmobit_footer_copyright_first_head',
		array(
			'type' => 'hidden',
			'label' => __('First Section','cosmobit'),
			'section' => 'cosmobit_footer_copyright',
			'priority'  => 1,
		)
	);
	
	// Image
	$wp_customize->add_setting( 
    	'cosmobit_footer_copyright_first_img' , 
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',	
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cosmobit_footer_copyright_first_img' ,
		array(
			'label'          => esc_html__( 'Image', 'cosmobit'),
			'section'        => 'cosmobit_footer_copyright',
			'priority' => 2,
		) 
	));
	
	
	// Link // 
	$wp_customize->add_setting(
    	'cosmobit_footer_copyright_first_link',
    	array(
			'default'   		=> esc_url( home_url( '/' ) ),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_footer_copyright_first_link',
		array(
		    'label'   		=> __('Link','cosmobit'),
		    'section'		=> 'cosmobit_footer_copyright',
			'type' 			=> 'text',
			'priority'      => 2,
		)  
	);	
	
	
	// Heading
	$wp_customize->add_setting(
		'cosmobit_footer_copyright_second_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cosmobit_footer_copyright_second_head',
		array(
			'type' => 'hidden',
			'label' => __('Second Section','cosmobit'),
			'section' => 'cosmobit_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer third text // 
	$cosmobit_copyright_content = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'cosmobit' );
	$wp_customize->add_setting(
    	'cosmobit_footer_copyright_second_text',
    	array(
			'default' => $cosmobit_copyright_content,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_footer_copyright_second_text',
		array(
		    'label'   		=> __('Copyright','cosmobit'),
		    'section'		=> 'cosmobit_footer_copyright',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	
	
	
	// Heading
	$wp_customize->add_setting(
		'cosmobit_footer_copyright_third_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cosmobit_footer_copyright_third_head',
		array(
			'type' => 'hidden',
			'label' => __('Third Section (Assign Footer Menu)','cosmobit'),
			'section' => 'cosmobit_footer_copyright',
			'priority'  => 5,
		)
	);
}
add_action( 'customize_register', 'cosmobit_footer_customize_settings' );