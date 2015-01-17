<?php
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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db531203140');

/** MySQL database username */
define('DB_USER', 'dbo531203140');

/** MySQL database password */
define('DB_PASSWORD', 'AVaZr7oXk4Iib94xOfZv');

/** MySQL hostname */
define('DB_HOST', 'db531203140.db.1and1.com:3306');

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
define('AUTH_KEY',         'XJ0NeS55F%WfAptrlWmic4@TY@WM&EYJf&#Q8)XHX*x)9WjC5SYHX(sWxPXCqhSU');
define('SECURE_AUTH_KEY',  '!NEo%eAOl1Tt5m9E$r@)#G&PmaG%9%Zj2F9f4WwdxAlBl%jB^qbtbosqq!Q@7VYn');
define('LOGGED_IN_KEY',    'z(UoGCD2l944fbCww((wlkg!8#laO@^#2nQ28sJHnmu7*KpDee)N&E6UghZwQo80');
define('NONCE_KEY',        'Ave$VHBY7y)zS$Ye!O7^a$NaHf8JsP9oaucIeeEkK*zioc4)Vq(gUG2WCR)(!Fg(');
define('AUTH_SALT',        'ED4hecxfS^MAfe@DwEm7mCxT(IArJfJ6rA%Hu91y!us@GXKkrMU8A%KTjtgye9Lc');
define('SECURE_AUTH_SALT', 'eE@WqVPZulKxJzRY8LcA#U9fMgZ@qL8u&rzw4F*AxsD8IQmCjbk)AHzfrRDBG9sW');
define('LOGGED_IN_SALT',   'TxMQ@ceALWHlCOMAViMs&Y&zpzkhaima(t5k3eNhW(Cd&PIdMlP(ZI^pVdFps7NE');
define('NONCE_SALT',       '&BVnzar2H82hA@w@hR6r4^Wbe&CVfWpiOHJkGy$F@dM@psXiVTQtXRT9Ud2bd0il');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Disable the Plugin and Theme Editor.
 *
 * Occasionally you may wish to disable the plugin or theme editor to prevent
 * overzealous users from being able to edit sensitive files and potentially crash the site.
 * Disabling these also provides an additional layer of security if a hacker
 * gains access to a well-privileged user account.
 */
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
