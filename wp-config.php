<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache




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
define('DB_NAME', 'coobo_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '2Tuf2I;,YRAc9:,?}Vpg(W=OI/_%I5/KD?_To4Q?6z_zWI!Rg12QQBV7p1:&^`|W');
define('SECURE_AUTH_KEY',  '1>TNCq_#(OX|zy@SgToozPcHQ}<D.G?-.1f7bu_p{ip^%K$NV[a45YQ<Lm,GE~#7');
define('LOGGED_IN_KEY',    'Gpc}B8i^[FxHnOkc+pq+f[*X4-~/p/{N?Qv3ZW+,UE<+O|+n,i(w`$45X}p*&[bu');
define('NONCE_KEY',        'Xlu}d# .=J9s7b?PN(L!l[&hH[%J(/z|Ez&z+<V,>pGU?MMET`4x| cZ5422?:rI');
define('AUTH_SALT',        'A9;}2;t1z;|*jz#Qo$*|h^Mnv0.WX+|PP9yP`S:$T,w>tr#iD>.`|UV+cl n?x`R');
define('SECURE_AUTH_SALT', 'Bfo<u- BP[4a;;4L2Q!i]W5+Jh1)FUZ@u 9)~R5K#b<`+QYp%M@OC=5xdf?$Ew(c');
define('LOGGED_IN_SALT',   '+=kLB}YP !mQ-)zNSX&bu?]}->lL*N9d,bo2UL!qFl9711L6Ne!<Y|{:9~aiT{vc');
define('NONCE_SALT',       ';yuPOO%,)]vZ#6a!=sRS>YAFc&:+jvcq0+H+#t|9g&|e3 fw_]: ;1/;~=y+YD?{');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
