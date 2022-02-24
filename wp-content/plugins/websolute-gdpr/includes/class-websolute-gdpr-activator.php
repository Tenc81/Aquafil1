<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.websolute.com
 * @since      1.0.0
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/includes
 * @author     Alessandro Lambertini <alambertini@websolute.it>
 */
class Websolute_Gdpr_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'gdpr_consent';
	$table_name2 = $wpdb->prefix . 'gdpr_iubenda_resp';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		Id varchar(50) NOT NULL,
		Mail varchar(128) NOT NULL,
		Subject_id varchar(50) NULL,
		Subject text NULL,
		Legal_notices text NULL,
		Context text NOT NULL,
		Data text NOT NULL,
		Preferences text NOT NULL,
		Timestamp datetime NOT NULL,
		PRIMARY KEY  (Id)
	) $charset_collate;";

	$sql2 = "CREATE TABLE IF NOT EXISTS $table_name2 (
		Id varchar(50) NOT NULL,
		Subject_id varchar(50) NULL,
		Subject_email varchar(50) NULL,
		Timestamp datetime NOT NULL,
		Consent_url varchar(128) NULL,
		Subject_url varchar(128) NULL,
		PRIMARY KEY  (Id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	dbDelta( $sql );
    dbDelta( $sql2 );
	add_option( 'websolute-gdpr_version', WEBSOLUTE_GDPR_VERSION );

	}

}
