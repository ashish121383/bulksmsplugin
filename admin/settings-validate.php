<?php // bulksmsplugin - Validate Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// callback: validate options
function bulksmsplugin_callback_validate_options( $input ) {
	
	// Api Key
	if ( isset( $input['api_key'] ) ) {
		
		$input['api_key'] = sanitize_text_field( $input['api_key'] );
		
	}
	
	// Secret key 
	if ( isset( $input['secret_key'] ) ) {
		
		$input['secret_key'] = sanitize_text_field( $input['secret_key'] );
		
	}
	
	return $input;
	
}


