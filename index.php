<?php
/**
 * Lakeshore Market Front End
 * Creates a front end shop for the Lakeshore Market service
 * @author Elliott Post
 */

//set up our system
define( "SECURITY_TOKEN", '0b8"]79/~~.+7-6V:-XK1?q{4D^+1@"L' );
require_once 'lib/config.php';

//get the requested template
if( !isset( $_GET['p1'] ) ) {
    require_once TEMPLATES_PATH . "index.php";
    return;
}

$p1 = strtolower( $_GET['p1'] );
if( !isset( $_GET['p2'] ) ) {
    require_once TEMPLATES_PATH . $p1 . ".php";
    return;
}

$p2 = strtolower( $_GET['p2'] );
if( !isset( $_GET['p3'] ) ) {
    require_once TEMPLATES_PATH . $p1 . "." . $p2 . ".php";
    return;
}

$p3 = strtolower( $_GET['p3'] );
require_once TEMPLATES_PATH . $p1 . "." . $p2 . "." . $p3 . ".php";