<?php
/**
 * Configuration settings for the LSM Front End
 * @author Elliott Post
 */

if( !defined( "SECURITY_TOKEN" ) || SECURITY_TOKEN !== '0b8"]79/~~.+7-6V:-XK1?q{4D^+1@"L' )
	die( "403 - Unauthorized Access" );

//set up site paths -- all paths should have trailing slash
define( "SITE_URI", "http://162.243.94.35/" ); 
define( "DS", DIRECTORY_SEPARATOR );
define( "LIB_PATH", SITE_ROOT . DS . "lib" . DS );
define( "CLASSES_PATH", LIB_PATH . "classes" . DS );
define( "INTERFACES_PATH", LIB_PATH . "interfaces" . DS );
define( "JS_PATH", SITE_URI . "lib" . DS . "js" . DS );
define( "CSS_PATH", SITE_URI . "lib" . DS . "css" . DS );
define( "FONTS_PATH", SITE_URI . "lib" . DS . "fonts" . DS );
define( "TEMPLATES_PATH", SITE_ROOT . DS . "templates" . DS );

//set up LSM Heroku App details
define( "LSM_API_ENDPOINT", "http://lsm1.herokuapp.com/services/lsm/" ); //should have trailing slash
define( "LSM_AA_EMAIL_HEADER_NAME", "email" );
define( "LSM_AA_PASS_HEADER_NAME", "password" );

//set up site settings
define( "DEBUG_API_CALLS", true );
setlocale( LC_MONETARY, 'en_US' );

//do our includes
#3rd party apps
require_once SITE_ROOT . DS . 'vendor/autoload.php';

#interfaces
require_once SITE_ROOT . DS . 'lib/interfaces/I_Util.php';
require_once SITE_ROOT . DS . 'lib/interfaces/I_Auth.php';
require_once SITE_ROOT . DS . 'lib/interfaces/I_LsmCurl.php';
require_once SITE_ROOT . DS . 'lib/interfaces/I_ApiLinks.php';

#classes
require_once SITE_ROOT . DS . 'lib/classes/Util.php';
require_once SITE_ROOT . DS . 'lib/classes/Auth.php';
require_once SITE_ROOT . DS . 'lib/classes/LsmCurl.php';
require_once SITE_ROOT . DS . 'lib/classes/ApiLinks.php';

