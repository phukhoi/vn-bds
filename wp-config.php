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
define('DB_NAME', '_bds_');

/** MySQL database username */
define('DB_USER', '_bds_');

/** MySQL database password */
define('DB_PASSWORD', 'BSr7USdE');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY', 'T6^:DKHiqt{/pAkY{FPyL3!kG(vZ)j{ZGz?1iWJ450Ojd6?d:MG]IpL0?1S5]}N?');
define('SECURE_AUTH_KEY', '1(0lwW*aP-Ikz[tKEI6F@3T; wk0AXGArqYX*KYz7:~ |>=7lsB~N:,lJ)kJjg7Q');
define('LOGGED_IN_KEY', 'pO|_9n~Nu|J^|;_^B;E:Vj*sntThARDVV14?,*tPp^PJy^q%+S%b?o?pzVw7+^IP');
define('NONCE_KEY', 'w3@c3yjGTS}}aR:4^<W _jZa(`Ii*;)xGSq>57Ilri!ylfcGex~+c;V@`${Mh>3<');
define('AUTH_SALT', '=xc#c|b&y1|W5WV/@Qu052[B>7^4&+*S~|xJ-bcA@>Q8T{IQ^Xlp1oZ^0Pa`_5D:');
define('SECURE_AUTH_SALT', ':L[<.bN~XpK9%i4=pTL7:26i1k65xzwtW)_FS}r.$z@YHqug.Dg 6;iB/86Of-YK');
define('LOGGED_IN_SALT', 'Ufp5J6FjCyLCGntrmbju#i<J$hbmwtuP[s}(8y[mxlR># 1q93VDromF]I&!)TzI');
define('NONCE_SALT', '1t?=C&^c1[;OR@Ce2eBBci@qIY|n$7!q~jQ%Fmb)zQ#_2CN(}IQnw;9}y2KRd`T]');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
