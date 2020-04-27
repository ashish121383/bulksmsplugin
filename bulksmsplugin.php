<?php
/*
Plugin Name:  Test Bulk Sms
Description:  Example plugin for the video tutorial series, "WordPress: Plugin Development", available at Lynda.com.
Plugin URI:   https://profiles.wordpress.org/specialk
Author:       Ashish Barman
Version:      1.0
Text Domain:  bulksmsplugin
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// load text domain
function bulksmsplugin_load_textdomain() {
	
	load_plugin_textdomain( 'bulksmsplugin', false, plugin_dir_path( __FILE__ ) . 'languages/' );
	
}
add_action( 'plugins_loaded', 'bulksmsplugin_load_textdomain' );



// include plugin dependencies: admin only
if ( is_admin() ) {
	
	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
	
}




