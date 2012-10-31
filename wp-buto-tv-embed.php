<?php
/**
 * Plugin Name: WP Buto TV Video Embed
 * Description: This allows for the embedding of Buto TV video content from their URLs
 * Version: 1.0
 * Author: Dachis Group
 * Author URI: http://dachisgroup.com
 *
 */
 if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) || !function_exists( 'add_action' ) ) {
	if ( !function_exists( 'add_action' ) ) {
		$exit_msg = 'I\'m just a plugin, please don\'t call me directly';
	} else {
		// Subscribe2 needs WordPress 3.1 or above, exit if not on a compatible version
		$exit_msg = sprintf( __( 'This version of WP Buto TV Embed required WordPress 3.1 or greater.' ) );
	}
	exit( $exit_msg );
}

// our version number. Don't touch this or any line below
// unless you know exactly what you are doing
define( 'WPBTEPATH', trailingslashit( dirname( __FILE__ ) ) );
define( 'WPBTEDIR', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
define( 'WPBTEURL', plugin_dir_url( dirname( __FILE__ ) ) . WPBTEDIR );


// Set maximum execution time to 5 minutes - won't affect safe mode
$safe_mode = array( 'On', 'ON', 'on', 1 );
if ( !in_array( ini_get( 'safe_mode' ), $safe_mode ) && ini_get( 'max_execution_time' ) < 300 ) {
	@ini_set( 'max_execution_time', 300 );
}

global $wpButoTVEmbed;

require_once( WPBTEPATH . 'classes/wpbte-core.php' );
require_once( WPBTEPATH . 'classes/wpbte-frontend.php' );
require_once( WPBTEPATH . 'classes/wpbte-admin.php' );

if ( is_admin() ){
    $wpButoTVEmbed = new WpButoTvEmbedAdmin();
} else {
    $wpButoTVEmbed = new WpButoTvEmbedFrontend();
}

$wpButoTVEmbed->init();
