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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'Tk7170042');

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
define('AUTH_KEY',         'UND[guLzI2D=c:t}l)K{8x*kn0~Nw.>MF^)2Ovou#{)nCpw8?yj6K n)]loh_=O<');
define('SECURE_AUTH_KEY',  '.TssnL+ *{NK,wjBJMJA)m2?;=1K<)dD28E}Yzq5i:pqTkm)3:=7ijAS}KR$TODo');
define('LOGGED_IN_KEY',    'F&V:V0<Qqj5!Fub06etIRB(tf~yi-S}n~v$9i:gcG8HIULQj<6<<y4!Ay<+{ NBo');
define('NONCE_KEY',        '1.4;8Fl_Ro#Si_|?v,e<AEk?tOKqU,+ONoz4KY~|*,wEmO:>jVGVv*Ve-g>8bKVn');
define('AUTH_SALT',        '>}.TEc=6]3<f,GCh?LTrk}mS,2<:.sIoVS<huZg}39i4t&;/n2Z {+b(>R$ZyT~e');
define('SECURE_AUTH_SALT', '>>bGD(IR+0KL:;vr3 51I4?RN!&&zcE5R1Uuk)8t:>DT7l{I!(R(aeI|eyu7f`7n');
define('LOGGED_IN_SALT',   'O]jc&=PJQ[z4i.lV]W%ou#0G$%nhuT<~)GAn)4^3@hfy1-#/rCSzzt_,9/Fz,uiq');
define('NONCE_SALT',       ' MTl`)dL%1`Ri)X;#e7+Lhg,gwG>3*q58}W]/:Ejtz d9&Cd:fwb?z.$}9S`VR~v');

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
