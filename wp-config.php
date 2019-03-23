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
define( 'AUTH_KEY',         '=Xd#)xoxIMK6|m$4;W.]$R~y/Y|VH4dOcA#Btw0frFvE_,m;Ywv#3AAU!SLYD[p1' );
define( 'SECURE_AUTH_KEY',  'qDAh}INh<F{cOM)`q!{s[FXL2NZ,EvQ*v<RQyQ*xE{31zH=XfK I&~z^F%W|uIme' );
define( 'LOGGED_IN_KEY',    'bB}>#v;Vp@u)$d7cC?;bOcUh/).T[a0EQ.+A.faf-.qPF,3qfn2WeC[8b.?^3T)K' );
define( 'NONCE_KEY',        '&]cmK`C9!Ne?h!c2v9rBz 3$#G0Ar+yrRTIDDZeGNTBP*:>T8R|z0q#?w~dHIegE' );
define( 'AUTH_SALT',        'G.hBu:a4wh|GW<7d$sfyouxLGvjjRCwY#gW^4/SV>+ Znf[SZ+s]u69B0d8zF4Ct' );
define( 'SECURE_AUTH_SALT', 'jER4z9a:!M%_,5&.(L*,}zS;BFq=}@7KOIR6ZY80dmo38Tq $%ootNzyhv7Ye11o' );
define( 'LOGGED_IN_SALT',   '9vF>uL,=FIYWP$x? Gtr>m,&CCl2M^25=MIt`|x$kW3y;D&k$tca~XwNRF;.E1-E' );
define( 'NONCE_SALT',       'G#{mk*`hYy_ump}}0s!%q1V;v ~vO$^1,FqTLNQJkxR=qvqf%4kPa5S:^+&I&=?`' );

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
