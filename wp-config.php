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
define('DB_NAME', 'wordpress-vue-masonry');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'tklau');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'p}i?L)3)[Py9/t}Mswa[:Ag%r)6Qi[@>g{6vH,7+%ULsraNGBCevQP_ZFsjK&HA,');
define('SECURE_AUTH_KEY',  '>#4c5KAT/NRo@N zf=WYI#098ecE/)uy3rcCu)#!rP`ic}RDj]S,ZLQ;U_{:CYY2');
define('LOGGED_IN_KEY',    '}+Lf% [~i]pjY|j>ju^rn2q]Rri4Z/d9[/H&n6O,)W#z^N]o7S&?-|#feZ@`&5p$');
define('NONCE_KEY',        'h=IvZ_F n0Hqd=c}1^yEqb,3dM<&z|4~CY&h~F|$*P3@3P@M78[OOk8~&1/{*<dS');
define('AUTH_SALT',        '5!y(<+#OS,V*@Qdpu}|u%0t$#3gt#-2I&Y=^Mm9|V!tI?wMKImB3g.nPR?L|JNT]');
define('SECURE_AUTH_SALT', 'j*JfAT0*FHrvDIJY<U-?9+%&+|C$p1GmHVP/7`(M*r;soKjNl=x<Al*>q=/JOO9#');
define('LOGGED_IN_SALT',   '$abeX2]5]~u)/>5!NFFPhzVNR{;b5,R.gfOF+GU&U!v[:7QEsfaXu~LLJ 4E6Flu');
define('NONCE_SALT',       ']UTVU}b )315M}^?pqc6iFk#)$_}it^@Q~MJ@jl!Js|MJYedlY+ prPY]tF*OcJk');

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
