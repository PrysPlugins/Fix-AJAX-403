<?php
/**
 * Plugin Name: 	Fix AJAX 403
 * Plugin URI:		https://github.com/PrysPlugins/Fix-AJAX-403
 * Description:		Prevent bad AJAX login requests from generating a 403 code
 * Version:		1.0
 * Author:		Jeremy Pry
 * Author URI:		http://jeremypry.com/
 * License:		GPL2
 * GitHub Plugin URI:	https://github.com/PrysPlugins/Fix-AJAX-403
 * GitHub Branch	master
 */

// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
	die( "You can't do anything by accessing this file directly." );
}

add_action( 'plugins_loaded', 'jpry_adjust_wpe_hooks' );
function jpry_adjust_wpe_hooks() {
	remove_action( 'wp_login_failed', 'wpe_login_failed_403' );
	add_action( 'wp_login_failed', 'jpry_login_failed_403' );
}

function jpry_login_failed_403() {
	// Don't 403 for Ajax requests
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
	status_header( 403 );
}
