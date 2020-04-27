<?php // bulksmsplugin - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// callback: login section
function bulksmsplugin_callback_section() {
	
	echo '<p>'. esc_html__('These settings enable you to customize the Api Section', 'bulksmsplugin') .'</p>';
	
}



// callback: admin section
function bulksmsplugin_callback_section_admin() {
	
	echo '<p>'. esc_html__('These settings enable you to customize the WP Admin Area.', 'bulksmsplugin') .'</p>';
	
}



// callback: text field
function bulksmsplugin_callback_field_text( $args ) {
	
	$options = get_option( 'bulksmsplugin_options', bulksmsplugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="bulksmsplugin_options_'. $id .'" name="bulksmsplugin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="bulksmsplugin_options_'. $id .'">'. $label .'</label>';
	
}








