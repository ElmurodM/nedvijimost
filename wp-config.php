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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'clicks' );

/** Database username */
define( 'DB_USER', 'clicks' );

/** Database password */
define( 'DB_PASSWORD', 'pQ9fM7oL8orQ7c' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Mqh[W3?cle3t/a0!w;M~6t z2@=*2C FM~rKhZe](KL%G5~@,1>k?UZ75-Qag6j`' );
define( 'SECURE_AUTH_KEY',  'eFRDA_O}35c|q7^EFfw]OOU8vwT1(LO$c1$o}!5#,3s+$bNqzO8TY+79<LMS@W/P' );
define( 'LOGGED_IN_KEY',    '#*](jWTV<9 voAB<u?XgAG3fm7bdxo|sBuF]Uk[N.zex}^GtDRB_Z^ ZysTOr XD' );
define( 'NONCE_KEY',        'hzg=_>36gG`Udvbab_6W$0mKy!e]$p*kPf#tUJms|xR^E[GCGS`o;|6EUH,~@U!j' );
define( 'AUTH_SALT',        '6,L55r>D;M<L-eoJ!9o3*<A=Y~0dZ`z D<~}<bu!*A:vP~OsbBNu~hVUxFnK$7k1' );
define( 'SECURE_AUTH_SALT', 'xt},Ll. ;_;!~0JmC%u(~&qq8kUm]~!Egy!&dVEZk$l2!XT)z*p`kffv}N9s%jJf' );
define( 'LOGGED_IN_SALT',   'G9&ZhXi<Z#AerMzpZ9St0Yywr-kL3 9J8D esm)QDVE?!-~;I04[H#e;K3tlcw6d' );
define( 'NONCE_SALT',       'X6~}%dRm!t^sy(G:?JL?jD1()&$X+>};pj7.T`t(KH+=f9>3mhgnl;L{hv|)4fz1' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
