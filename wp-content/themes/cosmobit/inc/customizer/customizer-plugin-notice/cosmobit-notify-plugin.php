<?php
/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-plugin-notice/cosmobit-customizer-notify.php';
$cosmobit_config_customizer = array(
    'recommended_plugins' => array( 
        'desert-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and sections of the Theme. please install and activate %s plugin', 'cosmobit' ), '<strong>Desert Companion</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'cosmobit' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'cosmobit' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'cosmobit' ),
	'activate_button_label'     => esc_html__( 'Activate', 'cosmobit' ),
	'cosmobit_deactivate_button_label'   => esc_html__( 'Deactivate', 'cosmobit' ),
);
Cosmobit_Customizer_Notify::init( apply_filters( 'cosmobit_customizer_notify_array', $cosmobit_config_customizer ) );