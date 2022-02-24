<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.websolute.com
 * @since             1.0.0
 * @package           Websolute_Gdpr
 *
 * @wordpress-plugin
 * Plugin Name:       Websolute GDPR
 * Plugin URI:        http://www.websolute.com
 * Description:       Struttura le informative - integra la gestione dei consensi alle informative attraverso shortcode personalizzati, interfacciandosi con IUBENDA
 * Version:           1.1.0
 * Author:            Websolute spa
 * Author URI:        http://www.websolute.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       websolute-gdpr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WEBSOLUTE_GDPR_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-websolute-gdpr-activator.php
 */
function activate_websolute_gdpr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-websolute-gdpr-activator.php';
	Websolute_Gdpr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-websolute-gdpr-deactivator.php
 */
function deactivate_websolute_gdpr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-websolute-gdpr-deactivator.php';
	Websolute_Gdpr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_websolute_gdpr' );
register_deactivation_hook( __FILE__, 'deactivate_websolute_gdpr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-websolute-gdpr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_websolute_gdpr() {

	$plugin = new Websolute_Gdpr();
	$plugin->run();

}
run_websolute_gdpr();


function displayInformativa( $atts ){

    $a = shortcode_atts( array(
        'id' => 1,
        'type' => 'post_content'
    ), $atts );
	$p = get_post($a['id'], ARRAY_A); // compatibility fix
	$filtered = apply_filters('filter_informativa_content', '', $a['type'], $p[$a['type']]);
	if($filtered != '') {
		return $filtered;
	} else {
		return nl2br($p[$a['type']]);
	}
}
add_shortcode( 'informativa', 'displayInformativa' );


##############################################################################
## update check ##############################################################
##############################################################################


$api_url = 'http://pkg2.websolute.it/';
$plugin_slug = basename(dirname(__FILE__));

// Take over the update check
add_filter('site_transient_update_plugins', 'check_for_plugin_update');

function check_for_plugin_update($checked_data) {
	global $api_url, $plugin_slug;
	
	if (!isset($checked_data) || !isset($checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php']))
		return $checked_data;
	
	$request_args = array(
		'slug' => $plugin_slug,
		'version' => $checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php']
	);
	
	$request_string = prepare_request('basic_check', $request_args);
	
	// Start checking for an update
	$raw_response = wp_remote_post($api_url, $request_string);
	
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$response = unserialize($raw_response['body']);

	    if (is_object($response) && !empty($response)) { // Feed the update data into WP updater
            if(isset($response->new_version)) {
		        $checked_data->response[$plugin_slug .'/'. $plugin_slug .'.php'] = $response;
            }
        }
    }
	return $checked_data;
}


// Take over the Plugin info screen
add_filter('plugins_api', 'my_plugin_api_call', 10, 3);

function my_plugin_api_call($def, $action, $args) {
	global $plugin_slug, $api_url;
	
	if ($action != 'plugin_information' || $args->slug != $plugin_slug)
        return false;
	
	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$plugin_slug .'/'. $plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = prepare_request($action, $args);
	
	$request = wp_remote_post($api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}


function prepare_request($action, $args) {
	global $wp_version;
	
	return array(
		'body' => array(
			'action' => $action, 
			'request' => serialize($args),
			'api-key' => md5(get_bloginfo('url'))
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);	
}