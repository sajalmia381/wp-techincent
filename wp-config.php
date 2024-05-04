<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
	function getenv_docker($env, $default) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}


define( 'WP_CACHE', getenv_docker('WP_CACHE', true) );
/** Enable W3 Total Cache */
 // Added by W3 Total Cache

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WP_DB_NAME', 'techlnpp_ti') );

/** MySQL database username */
define( 'DB_USER', getenv_docker('WP_DB_USER', 'techlnpp_ti') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv_docker('WP_DB_PASSWORD', '5p7Li3eZessHSZu') );

/** MySQL hostname */
define( 'DB_HOST', getenv_docker('WP_DB_HOST', 'mysql') );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WP_DB_COLLATE', '') );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv_docker('WP_AUTH_KEY',         'p92m5cxql8jgrhfyhlt7d00delf42gstpzt8o9o49') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WP_SECURE_AUTH_KEY',  'yw6l2py9jfumxo7w3l2t54z69rux8j8k4etywrhgy') );
define( 'LOGGED_IN_KEY',    getenv_docker('WP_LOGGED_IN_KEY',    'ahfh8ha110jq775uiy1q0orx30b2vd9piy2x6zkip') );
define( 'NONCE_KEY',        getenv_docker('WP_NONCE_KEY',        'o51d1lzecry6wvog04yr76r53170bhpzeudiqjzot') );
define( 'AUTH_SALT',        getenv_docker('WP_AUTH_SALT',        'cxclfgk0bp7me81012s9x35iwk0jes8dp5f8wfvvs') );
define( 'SECURE_AUTH_SALT', getenv_docker('WP_SECURE_AUTH_SALT', 'hm6eh1o31v7kvpph4xvzxfjvu1c1ljro8a3wujziq') );
define( 'LOGGED_IN_SALT',   getenv_docker('WP_LOGGED_IN_SALT',   'r1lgkh0uizrsu7jo0j2r2u8xvr61rfyeyxs31f89c') );
define( 'NONCE_SALT',       getenv_docker('WP_NONCE_SALT',       'iox6dl648j44vgeyfk7qavcmxq6wgbgxi9qv1ugum') );
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv_docker('WP_TABLE_PREFIX', 'wp_') ;

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', !!getenv_docker('WP_DEBUG', '') );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
