<?php
/**
 * Configuration settings for the LSM Front End
 * @author Elliott Post
 */

if( !defined( "SECURITY_TOKEN" ) || SECURITY_TOKEN !== '0b8"]79/~~.+7-6V:-XK1?q{4D^+1@"L' )
	die( "403 - Unauthorized Access" );

//set up site paths -- all paths should have trailing slash
define( "SITE_URI", "http://162.243.94.35/" ); 
define( "SITE_ROOT", dirname( dirname( __FILE__ ) ) );
define( "DS", DIRECTORY_SEPARATOR );
define( "LIB_PATH", SITE_ROOT . DS . "lib" . DS );
define( "CLASSES_PATH", LIB_PATH . "classes" . DS );
define( "INTERFACES_PATH", LIB_PATH . "interfaces" . DS );
define( "JS_PATH", LIB_PATH . "js" . DS );
define( "CSS_PATH", LIB_PATH . "css" . DS );
define( "FONTS_PATH", LIB_PATH . "fonts" . DS );
define( "TEMPLATES_PATH", SITE_ROOT . DS . "templates" . DS );

//set up LSM Heroku App details
define( "LSM_API_ENDPOINT", "http://lsm1.herokuapp.com/services/lsm/" ); //should have trailing slash
define( "LSM_AA_EMAIL_HEADER_NAME", "email" );
define( "LSM_AA_PASS_HEADER_NAME", "password" );

//do our includes
#interfaces
require_once 'lib/interfaces/I_LsmCurl.php';
require_once 'lib/interfaces/I_Util.php';

#classes
require_once 'lib/classes/LsmCurl.php';
require_once 'lib/classes/Util.php';

