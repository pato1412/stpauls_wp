<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
define('WP_CACHE', true); // WP-Optimize Cache
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
 
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'DB_NAME', 'wp_stpauls' );
/** MySQL database username */
define( 'DB_USER', 'root' );
/** MySQL database password */
define( 'DB_PASSWORD', '' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ' ?b`2T{<A1@uNO*@A,kYc[+cN*[eno0iL.4T2:#LH~3qN6al5Z76/3]$?.I^,-_W' );
define( 'SECURE_AUTH_KEY',  'iIEG^H} K(Uc Xq+,lg[_E&mG6Q*.0lcZw:$8a2</2iY]k2fz52:;5KD$/TO|=xP' );
define( 'LOGGED_IN_KEY',    'Ynob$89f=Z)iWD-({8dk3-sx4h{BnOC<kWvK8Fy79L&rl#51TIeFO0ZSkU*z<}WS' );
define( 'NONCE_KEY',        '4IFzo2Q7?H<nx+umNN=q^:n0LAuQbQI]c0Z?EDmQ25~jk7p<,,GwharZICL0=LO^' );
define( 'AUTH_SALT',        '.0[/B}u&6z,7SAgCdxv}cnTYW8/ lV2-y/}1bj7gcET4lPue|cDge+C?BP}[VAV2' );
define( 'SECURE_AUTH_SALT', 'G.tY9}?L$YSG?xB;Ac1jHRXR?sJeTcRiIo>[AU33B`tTiC%=?]{rk;+,S>CfU[rc' );
define( 'LOGGED_IN_SALT',   'ejJ&d0Zm.dt=kgGnRC3^bxk]fd-,7t )BV(vC^4q,{GEL{X;,Yfbus5=7aO;[nU~' );
define( 'NONCE_SALT',       'PHh9e~ x:.cB,|<jtcqjLo%;LNCcN#VqJ6eTn7b?.+{Jcx0Bs1e5tA9D_aFRw}1h' );
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';