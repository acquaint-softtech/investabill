<?php
define( 'WP_CACHE', true ); // Added by WP Rocket





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

define( 'DB_NAME', "live_investabill" );


/** MySQL database username */

define( 'DB_USER', "root" );


/** MySQL database password */

define( 'DB_PASSWORD', "root" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );


/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );


/*remove br tag from contact form 7*/

define( 'WPCF7_AUTOP', false );

/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         ',e~r!EmRuvdJZwf/c}P&*cc96Op*pG^97`!5v}a]S@0u{Y@fbK okvc9+S~-^tHD' );

define( 'SECURE_AUTH_KEY',  '5pQT<f,2qFGOg2^6)^%wQg@iiu?dR(O.`QlO:Yit7Cp&n!6~4#d1//JEEs)a[[7Z' );

define( 'LOGGED_IN_KEY',    '4B+5D%9@Z4f`..M%bD=%plOJ!HVd#DS8J8T%)-bUZQ)*^IvZld6-h>!Y$x8-Zf`*' );

define( 'NONCE_KEY',        '_ZV]Swd-$lH0Cuvo!p&-Jb8o+p)=xrt/O=hEQaj.{N9?}_t+tB~l,u~oaef82*],' );

define( 'AUTH_SALT',        'y+g:}3fg&F~>MlG(07tDJOuH:#KXw^[h<zgw8ZC:{j[]O[W~>Uf|;4/&`Ha[=r$V' );

define( 'SECURE_AUTH_SALT', '.#/n|%8V2&;R&QR41}LoGD0P2K=:{ml}P+J6h(^WRr|%l<I.g~3Y_t-rK28e5K:H' );

define( 'LOGGED_IN_SALT',   '$qH-9N4P`gC2QrDh$GbRc4<6s?Zf,oUS<z8()2>v!l}$zY2% 7I2SNh_4++Ig:)i' );

define( 'NONCE_SALT',       '5H/,@8?=U&5Uz2c*`9)*N/Pm)fU-0B$b9]4-c?TP{-[W,hs}I6/G#`FD_1b9l`9n' );


/**#@-*/


/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'tc_';


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

define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );


define( 'WP_HOME', 'http://localhost/investabill' ); 
define( 'WP_SITEURL', 'http://localhost/investabill' );

define('ALLOW_UNFILTERED_UPLOADS', true);

/* That's all, stop editing! Happy publishing. */

// define( 'ENDPOINT_URL' , 'https://api.test.dealmakersystem.com/dm/create-lead-from-guest');
// define( 'API_KEY' , '77d9fbffeb8b41092c0259694ae61e00910fe0c9');
// define( 'API_SECRET' , '9e30fd67a66210f2a91efff26d39b1e3');
// define( 'LEAD_SOURCE_DETAIL' , 'Questionnaire - Trade Credebt');


//Live
define( 'ENDPOINT_URL' , 'https://api.test.dealmakersystem.com/dm/create-lead-from-guest');
// Test 
// define( 'ENDPOINT_URL' , 'http://dma-api.silicontechnolabs.com:8010/dm/create-lead-from-guest');
define( 'API_KEY' , '77d9fbffeb8b41092c0259694ae61e00910fe0c9');
define( 'API_SECRET' , '9e30fd67a66210f2a91efff26d39b1e3');
define( 'LEAD_SOURCE_DETAIL' , 'Questionnaire - Investabill');
define( 'LEAD_SOURCE' , 'Questionnaire - Investabill');




/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';
