<?php
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
define('DB_NAME', 'silippin_dev');

/** MySQL database username */
define('DB_USER', 'silippin_devadm');

/** MySQL database password */
define('DB_PASSWORD', 'Gr0rwr9vSRi2');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qnifxjsuewgz8w10qwjbzt5ypze8fmwv1jut34h6wzpwyys7mlqpo9rik6tibxz8');
define('SECURE_AUTH_KEY',  '08r6bllg6jadhjed5ygtgtobvxzojrr4yepll0zrlemkyabaojatkwi5z0uwfjfz');
define('LOGGED_IN_KEY',    'qcwog1fhh0sfc4elhoskretfrmexpkdewvkfiz7ws22xof7naiwna8lu0twf0lyf');
define('NONCE_KEY',        'pourbocdqco5ahlrv8hxpfij3ts8k98yhaqdoq5rm30giehk2cepoctehhkesgvr');
define('AUTH_SALT',        '4i8pj3qcav4tozqvhgsikceureicl9ioqpleitybacmtvbjp8fkf0lr4vglsrktm');
define('SECURE_AUTH_SALT', 'dm7l9k2zrfkwkswwshnnsvuj7upisumrfl2j8flrdng4loncln4ruopwwunldc9e');
define('LOGGED_IN_SALT',   'ynqwmwi1ytl4cgofkijqkd85denr1ncrbr5mqurhf3tubokhr37aehyvtcivg4sa');
define('NONCE_SALT',       'dxeh2cepqjldryguidiemmny4fhei1zymcchvrc0rqw9kjnalynptadikxlpeh0m');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpa1_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
