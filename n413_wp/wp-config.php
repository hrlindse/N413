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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'n413_wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define( 'AUTH_KEY',         'INl1(DOr^$}|VC5h^<8:x(J<j9G: LVWeNf>Q].MAY##HHFG#qQ(}+^i2t<tY{V}' );
define( 'SECURE_AUTH_KEY',  '%2~j6woHUDjXBONe+rTt]hq~g`AG}%9FZ=W+&<QF%Yd 8d6uKkk{Z;J{Q@QP,;^.' );
define( 'LOGGED_IN_KEY',    'C0)0LoF^n!jLI~Di5X?X*-.B,cDliqmfS:BDQkS`wfH7ovE1Twr/zi{P/m_,J=<K' );
define( 'NONCE_KEY',        'BYJwB@s*^;tY,!yrK:`| 1~7?v;{&0&rr<6B]:Yrtv/Ub35D[z2`5~04pgW@b8dh' );
define( 'AUTH_SALT',        ' ^i~GcF+*r62)il)#F?d@p`kqa_$xBXkEG*FPvhx@;}]:!FT*7G$$Qu@X:wy*HLS' );
define( 'SECURE_AUTH_SALT', '&$:sn^IVC416@]GxSJZ!Mk+A%1!Jy@ q#/UZ0xg]b^+yr:uaszp(o-tJluinZ6[D' );
define( 'LOGGED_IN_SALT',   'jFNz~mal;,F(NPK`x`nZPGzA#^=lGEf|`jR[TXZ@sYLOq<}v|ka{;eijr]k[u-|-' );
define( 'NONCE_SALT',       'Hs-AM]!78aUrH)ZIq9PXjW(]k!F0)*0RqnYH5<I:KZ?VZ=a=2q!UbI{PQadHUqGA' );

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
