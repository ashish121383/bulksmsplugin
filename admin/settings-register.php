<?php // bulksmsplugin - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// register plugin settings
function bulksmsplugin_register_settings() {
	
	/*
	
	register_setting( 
		string   $option_group, 
		string   $option_name, 
		callable $sanitize_callback = ''
	);
	
	*/
	
	register_setting( 
		'bulksmsplugin_options', 
		'bulksmsplugin_options', 
		'bulksmsplugin_callback_validate_options' 
	); 
	
	/*
	
	add_settings_section( 
		string   $id, 
		string   $title, 
		callable $callback, 
		string   $page
	);
	
	*/
	
	add_settings_section( 
		'bulksmsplugin_section', 
		esc_html__('Customize Login Page', 'bulksmsplugin'), 
		'bulksmsplugin_callback_section', 
		'bulksmsplugin'
	);
	
	
	
	add_settings_field(
		'api_key',
		esc_html__('Api Key', 'bulksmsplugin'),
		'bulksmsplugin_callback_field_text',
		'bulksmsplugin', 
		'bulksmsplugin_section', 
		[ 'id' => 'api_key', 'label' => esc_html__('Please enter Api key', 'bulksmsplugin') ]
	);
	
	add_settings_field(
		'secret_key',
		esc_html__('Secret Key', 'bulksmsplugin'),
		'bulksmsplugin_callback_field_text',
		'bulksmsplugin', 
		'bulksmsplugin_section', 
		[ 'id' => 'secret_key', 'label' => esc_html__('Please Enter Secret Key', 'bulksmsplugin') ]
	);
	
}
 
add_action( 'admin_init', 'bulksmsplugin_register_settings' );


