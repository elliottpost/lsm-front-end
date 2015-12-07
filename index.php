<?php
/**
 * Lakeshore Market Front End
 * Creates a front end shop for the Lakeshore Market service
 * @author Elliott Post
 */

//set up our system
define( "SECURITY_TOKEN", '0b8"]79/~~.+7-6V:-XK1?q{4D^+1@"L' );
define( "SITE_ROOT", dirname( $_SERVER['SCRIPT_FILENAME'] ) );
require_once SITE_ROOT . '/lib/config.php';

// echo "<pre>"; var_dump( $_GET );echo "</pre>";

//start our session
Auth::startSession();

//get the requested template
if( !isset( $_GET['p1'] ) ) {
	Util::getTemplate( 'index.php' );
    return;
}

$p1 = strtolower( $_GET['p1'] );
if( !isset( $_GET['p2'] ) ) {
    Util::getTemplate(  $p1 . ".php" );
    return;
}

$p2 = strtolower( $_GET['p2'] );
if( !isset( $_GET['p3'] ) ) {
    Util::getTemplate(  $p1 . "." . $p2 . ".php" );
    return;
}

$p3 = strtolower( $_GET['p3'] );
Util::getTemplate(  $p1 . "." . $p2 . "." . $p3 . ".php" );