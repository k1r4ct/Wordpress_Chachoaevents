<?php
define( 'WP_CACHE', true );

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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u335551125_XDur7' );

/** Database username */
define( 'DB_USER', 'u335551125_AY3wH' );

/** Database password */
define( 'DB_PASSWORD', 'l0qLEtDeLQ' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'U2/hk}<ck[);Zk!_:@Gsc|!2s~ i `ozJdY{FlCl4Zo^7;:[BN[cWek3b{e:crvw' );
define( 'SECURE_AUTH_KEY',   'D7JheVbfFsf=Q)v,%aSJ@yk/ETx+7szH?TpHHK]l&1[|C.{k_TP)s{[wQglI#l2K' );
define( 'LOGGED_IN_KEY',     'pOj=yjG3_#mV&e4UFgS0J0&JAS^Ukbaxi#I^}AHzw^a]s f;u}S*6Xbte^7b_Z^D' );
define( 'NONCE_KEY',         'E|SiK]4=9K)!Ns!jyc*+=:+T!~5y{9.uq.DuXc8Y}P5HJaI^D~KJme/pdSUI3ZON' );
define( 'AUTH_SALT',         '!>MyVBh8wY@2&*[:lFG|OT({Ba;ih-LX;.8@NqPacXUrwd]UA@rwifxVl!iO7sQ?' );
define( 'SECURE_AUTH_SALT',  'Xb0u_nxGcBBi<!^i=-StYj:2Qn&s2!@U+GOE]6r9$(2IvQH5`kA!F0[[w0GES_n!' );
define( 'LOGGED_IN_SALT',    ' [r(GVTTtaJG3HV*1h[4E8Ztn /[Q14Dtf{q(t|oq3^2w3Uz0PfSwLL3f*:xJ3R,' );
define( 'NONCE_SALT',        '/K)qVY,,%i _; ;vr7a{z2Ch4mHBZ8irb}anL}se=]x{wmeHNT2_|Fr|]9%~YgcE' );
define( 'WP_CACHE_KEY_SALT', ')OlH*rO&PV1*:tu/HXF%jY#]tKx3WSMVd~Yk2mh-L5nuL5I*tE+R*]1COwKjq2L@' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '132f53108976871e187f052122c1b11c' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
