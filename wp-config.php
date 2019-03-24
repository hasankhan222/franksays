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
define( 'DB_NAME', 'franksays_db' );

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
define( 'AUTH_KEY',         'X`bw5]%ta9swvGV[<XiYbzQ*W;(ZGw0HMi(!+}x_G<MsAR[2&LJX#{0`-vF/%E`H' );
define( 'SECURE_AUTH_KEY',  'LxB@:*i|npBb{v-HWw8I))I;^Bgu5YcE}OKL4$s8ZOBZoyKG4a`~V)PMDe$]#*&g' );
define( 'LOGGED_IN_KEY',    'AXKuuiq_:5qFIuJ!pCe1Y|9WKQ$2AYL!C@3O%OG&WQ|6qR%;/4mw>egkKk-Lf/D]' );
define( 'NONCE_KEY',        'rC=v4qqbVAVl.z5Q9zrA#x({e!W6l_OT%9z=qh3 8JdUvO?H8N/c<@OKvvh^T<)S' );
define( 'AUTH_SALT',        'TP$Cq(R@}v xFO[-@v5~U!jMdSD4tj)i+`O9BWoWLhdUaEFm`5@& [giS8QdgZ-%' );
define( 'SECURE_AUTH_SALT', ' v+{dA2p}%x|tSVd>YQ~r:O_g~Z`q-1o%Np`C<Imq~g;bto)bLnZ[02[P<uu%kcX' );
define( 'LOGGED_IN_SALT',   'p+_{oSs$vM-4dtdEGNQO])6SQ~6]oGDNqz%D)gLgDe}rQ*(cS)0I/p/O;@Z!g*Rk' );
define( 'NONCE_SALT',       '89%^mcu%dlbHG&PyE80v@=U2?2)z5>xSqUQ~uFgOQD_4zXuy;jIw)]~-9]GN(hrc' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
