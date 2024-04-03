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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gourmetartistdb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'myrootpassword' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );

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
define( 'AUTH_KEY',         ' DMz~-mN?6LEk4Spl6|ln.1S2*+SObnCFW0gJAvv21j;0COD.C2RFh0&ULi1<)g@' );
define( 'SECURE_AUTH_KEY',  '`eUWJ`XLc3Pb&eL>R@q3E7~l[ViN2l}tkZ JEpJhH5?Aygp@JeT>}~a {dNN~;Wv' );
define( 'LOGGED_IN_KEY',    'FO(2!o!y3J;*gYx>*I*2Mqi~E_BWNrX0*Hr(ybmn~Is7DQn!5[MiPKt4)VB.f[5`' );
define( 'NONCE_KEY',        '}$PXZWc?;= :+t&)H=6JG$F ?CMoQQ}t5>Q7w(+*xy5^y:m^v bSZ=$tS!9yS+uc' );
define( 'AUTH_SALT',        '@<@rg~9P|E3(<^5j0_3TcN5{?oF22%G1>;<?XL/t&_vMUD!bn,%mm!<=mLn64h]p' );
define( 'SECURE_AUTH_SALT', '&c$b$)w:05z9l+j.d0C^qQU+csmLFnD=yT0Y<27cm|Ny(e]]MJ%Gj`{g7 hxJR%)' );
define( 'LOGGED_IN_SALT',   'j|;gw)#>UG_k;{KCz>,yAA|>1mem7|v]lyzsbU^%IxxO`W^m}&)i|7HA jhSW:^f' );
define( 'NONCE_SALT',       '}`4/|T@h2E=;3-lSymx4;NMmRl5TaN}lMQW{})pcmVG,{Hn5*l|AA1opI,*oFu5I' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
