<?php
function cosmobit_site_selective_partials( $wp_customize ){
	// cosmobit_hdr_contact_title
	$wp_customize->selective_refresh->add_partial( 'cosmobit_hdr_contact_title', array(
		'selector'            => '.dt__header-widget .contact1 .contact__body .title',
		'settings'            => 'cosmobit_hdr_contact_title',
		'render_callback'  => 'cosmobit_hdr_contact_title_render_callback',
	) );
	
	// cosmobit_hdr_email_title
	$wp_customize->selective_refresh->add_partial( 'cosmobit_hdr_email_title', array(
		'selector'            => '.dt__header-widget .contact2 .contact__body .title',
		'settings'            => 'cosmobit_hdr_email_title',
		'render_callback'  => 'cosmobit_hdr_email_title_render_callback',
	) );
	
	// cosmobit_hdr_top_mbl_title
	$wp_customize->selective_refresh->add_partial( 'cosmobit_hdr_top_mbl_title', array(
		'selector'            => '.dt__header-widget .contact3 .contact__body .title',
		'settings'            => 'cosmobit_hdr_top_mbl_title',
		'render_callback'  => 'cosmobit_hdr_top_mbl_title_render_callback',
	) );
	
	// cosmobit_hdr_top_time_title
	$wp_customize->selective_refresh->add_partial( 'cosmobit_hdr_top_time_title', array(
		'selector'            => '.dt__header-widget .contact4 .contact__body .title',
		'settings'            => 'cosmobit_hdr_top_time_title',
		'render_callback'  => 'cosmobit_hdr_top_time_title_render_callback',
	) );
	
	// cosmobit_hdr_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_hdr_btn_lbl', array(
		'selector'            => '.dt__navbar-button-item a',
		'settings'            => 'cosmobit_hdr_btn_lbl',
		'render_callback'  => 'cosmobit_hdr_btn_lbl_render_callback',
	) );
	
	// cosmobit_hdr_contact_details
	$wp_customize->selective_refresh->add_partial( 'cosmobit_hdr_contact_details', array(
		'selector'            => '.dt__navbar-right .dt__navbar-listwidget .widget_contact',
	) );
	
	// cosmobit_footer_top_info
	$wp_customize->selective_refresh->add_partial( 'cosmobit_footer_top_info', array(
		'selector'            => '.dt__footer-top .dt-row',
	) );
	
	// cosmobit_footer_copyright_second_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_footer_copyright_second_text', array(
		'selector'            => '.dt__footer-copyright .dt__footer-copyright-text',
		'settings'            => 'cosmobit_footer_copyright_second_text',
		'render_callback'  => 'cosmobit_footer_copyright_second_text_render_callback',
	) );
	}
add_action( 'customize_register', 'cosmobit_site_selective_partials' );