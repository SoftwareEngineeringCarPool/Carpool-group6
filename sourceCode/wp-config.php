<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'empty');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '%AT1g|pk%L1Ca*]nj4Ad-A[~x`zA#Y_B$m<<zt^/>`e +Q(;U=ctja/:6&RA{K~l');
define('SECURE_AUTH_KEY',  'Y0J5E$n>^L/d3H=rZp0cbDyNy.xTDO%$p0QY;}*Ur!@wA+j?XpxA /=GjT8qT~jT');
define('LOGGED_IN_KEY',    '4&?C{VF,#4<+7Tu?fx(1m;n[dWAR3[16>(q))%xlv/F*>m[w9O}Xhww1*%GJe>T/');
define('NONCE_KEY',        'tV[<-E>QA^JoI+/,XkLaeo;(S#tQts62KwoM:oiE!bkUd~2bvGJPEfs=?Nyzf`oH');
define('AUTH_SALT',        '!E^b>sMB;SVmpm;BHk7SIaqKH~,3nMyTbE(=HPJ 4Dy_7!w%TmEsrgPo]eDfnK5:');
define('SECURE_AUTH_SALT', '5Xi(PI=xo22=U3i^IVr^|0?t1e$[L9G1)u!HMI=3ho*okN!2i<_0DK5;M:3c>{uE');
define('LOGGED_IN_SALT',   'f*]}D];7r!mqZxa<Tsd[c+M4~j-K>Kv#Q2;n:Sioa84$rihhPsYS^Pw,_HLIK)QG');
define('NONCE_SALT',       'cN]9{O[Cx4su[VCwD]Im=RhYXC7oa;b.C{d!Ih{ds?_Z>uW.4EXC,o4x55IaSFCN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
