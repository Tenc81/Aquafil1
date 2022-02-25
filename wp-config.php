<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('WP_USE_DB_DEVEL', true);

if(WP_USE_DB_DEVEL) {
    // ** Impostazioni MySQL - � possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
    /** Il nome del database di WordPress */
    define('DB_NAME', 'aquafilsql1');

    /** Nome utente del database MySQL */
    define('DB_USER', 'aquafilsql1');

    /** Password del database MySQL */
    define('DB_PASSWORD', 'CiBsnw6YEAcA3c1C');

    /** Hostname MySQL  */
    if(in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1' )))
        define('DB_HOST', '192.168.0.227');
    else
        define('DB_HOST', 'localhost');
	define('GOOGLE_API_KEY', 'AIzaSyADmr6lAc0DFdUXSsQqpnxzdM7kqrjnIbw');
} else {
    // ** Impostazioni MySQL - � possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
    /** Il nome del database di WordPress */
    define('DB_NAME', '');

    /** Nome utente del database MySQL */
    define('DB_USER', '');

    /** Password del database MySQL */
    define('DB_PASSWORD', '');

    /** Hostname MySQL  */
    if(in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1' )))
        define('DB_HOST', '');
    else
        define('DB_HOST', 'localhost');
	define('GOOGLE_API_KEY', '');
}

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

//// define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
//// define('WP_TEMP_DIR',dirname(__FILE__).'/assets/uploads');
//// define('WP_CONTENT_DIR', dirname(__FILE__) . '/assets');
//// define('WP_CONTENT_URL', $_SERVER['APP_URL'] . '/assets');

define('WP_MEMORY_LIMIT', '256M');

define( 'AUTOMATIC_UPDATER_DISABLED', true );

define('GOOGLE_API_KEY', 'AIzaSyADmr6lAc0DFdUXSsQqpnxzdM7kqrjnIbw');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(WK.n*E&[ZZiMO_}`L8=3|F<JsHi^y!+)EB #A[1Tbx=!j KU4wS]htU{RGk_^E1');
define('SECURE_AUTH_KEY',  '> MZ0abzoW0|{|ma~hZOb@5Rj~lCnKJs3+l,F5O-bdcI<[4Z>D9th^X8INAl0$}G');
define('LOGGED_IN_KEY',    '{EEO=Ks8+T6mA( x5|,vw`]{H}O+jB~,odCAu0#Gm5X1^H)Gw}SeZm f/sVQ6QZq');
define('NONCE_KEY',        '$-i+ D`*t:]_NaZEE0X6h/|iP/L*wV@A@|!1i uz%p,DSAY4+0ml}nK#X{n0jLVS');
define('AUTH_SALT',        '9t!$bdz@H)_jCD2yUTA7><yB!,zZ`h-Bvb+aKrmQFH{Qm-xuW.SgPr+[TEAq.dy+');
define('SECURE_AUTH_SALT', 'P%+1 w!dt_8$dup#M2GU3;FF): JiryTVtLnWRlfYJvQ[6,[_Uy0C)>dgDYQko9m');
define('LOGGED_IN_SALT',   '7K>!VY&/9m>ZR&<fZ^A0s*7Q=X{l=h~FGSjL>wWcSKYmTVHL9_zgG^=2Z/i)Ub&9');
define('NONCE_SALT',       '> u:;-,v1^83]45Sj[nC0_|j-h~Y+v{L-bM~~1{Jhg)tx-pKsl5uOJgK`izDh`R?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
define('WPS_DEBUG', true);
define('WPS_DEBUG_SCRIPTS', true);
define('WPS_DEBUG_DOM', true);

define('WP_POST_REVISIONS', 1);
define('AUTOSAVE_INTERVAL', 86400);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Impostazione della nuova cartella dei contenuti. */
$host = $_SERVER['HTTP_HOST'];

if ((!empty($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https") ||
  (!empty($_SERVER["REQUEST_SCHEME"]) && $_SERVER["REQUEST_SCHEME"] == "https") ||
  $_SERVER['SERVER_PORT'] == 443)
	$_SERVER['HTTPS']='on';

$protocol = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off' || $_SERVER['HTTPS'] === 0 ? "http://" : "https://";

define('WP_STAGE_URL', 'aquafil.wslabs.it');
define('WP_PRODUCTION_URL', 'aquafil.wslabs.it'); //temporaneo
define('WP_OUTER_URL', $protocol === WP_PRODUCTION_URL ? WP_PRODUCTION_URL : WP_STAGE_URL);
define('WP_SCHEME', $protocol);
define('WP_ROOT', '/');
define('WP_HOME', $protocol . $host . WP_ROOT);
define('WP_SITEURL', WP_HOME);
define ('WP_CONTENT_FOLDERNAME', 'wp-content');
define ('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME);
define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME );
define('UPLOADS', 'assets/uploads');
define('WP_CDNURL', $protocol . WP_OUTER_URL . WP_ROOT . 'assets/uploads');

define('DOCS_DIR', WP_CONTENT_URL.'/themes/aquafil/client/docs/');


/** Imposta le variabili di WordPress ed include i file. */

require_once(ABSPATH . 'wp-settings.php');

/** Specifica username e password FTP per aggiornamento da backend */
define('FS_METHOD', 'direct');
