<?php
/*
Plugin Name: WP App Logger
Description: Allows developer to put do_action( 'wp_app_log', 'Descriptor', $variable ) and log the values to user- and date- specific log files
Plugin URI: https://github.com/andrej1c/wp-app-logger
Author: Andrej Ciho
*/

class AC_WP_App_Logger {
	function log( $source = '', $message = '' )  {	
		if ( empty( $source ) ) {
			return;
		}
				
		if ( is_array( $message ) || is_object( $message ) ) {
			$message = json_encode( $message );
		}
		
		// Grab username
		global $current_user;
		$user_name = empty( $current_user ) ? 'notloggedin' : $current_user->user_login;
		
		// Open File and Write
		$filename = dirname(__FILE__) . '/logs/print-' . date( 'Y-m-d' ) . '-' . $user_name . '.log';
		if ( ! $handle = @fopen( $filename, 'a' ) ) {
			return;
		}
		@fwrite( $handle, $source . ':' . $message . "; --" . date('H:i:s') . "\n");
		@fclose( $handle );
	}
}

if ( defined( 'WP_DEBUG_LOG' ) ) {
	if ( true == WP_DEBUG_LOG ) {
		add_action( 'wp_app_log', array( 'AC_WP_App_Logger', 'log' ), 1, 2 );
	}
}