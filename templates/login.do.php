<?php
/**
 * Processes a request to login
 */

//if already auth, get out of here
if( Auth::isAuthenticated() ) {
    Util::getTemplate( 'index.php' );
    return;
}

//ensure user submitted credentials
if( !isset( $_POST['email'], $_POST['password'] ) ) {
    Util::getTemplate( 'login.php' );
    return;
}

//add credentials to session
Auth::authenticate( $_POST['email'], $_POST['password'] );

//test credentials
$lsm = new LsmCurl( false ); //force debug mode off
$lsm->setEndpoint( LSM_API_ENDPOINT . "authenticate" );
$lsm->useGet();

//send the request
$lsm->sendRequest();

$status = (int) $lsm->getResponseStatus();
$response = $lsm->getResponseContent();

if( !$response ) {
	Auth::destroySession();
	Auth::startSession();

    Util::getTemplate( '500.php' );
    return;
}

if( $status < 200 || $status > 204 || @!$response->isSuccess ) {
	//error validating
	Auth::destroySession();
	Auth::startSession();

	// if( DEBUG_API_CALLS )
	//     echo "<pre class='debug'>"; var_dump( $response ); echo"</pre>";

	// $error = $response->message;
	$GLOBALS['error'] = "There was a problem logging you in. Check your credentials and try again. For support, contact 1-800-555-LSM1.";
    Util::getTemplate( 'login.php' );  
    return;
}

//authenticated successfully
header( "Location: " . SITE_URI );