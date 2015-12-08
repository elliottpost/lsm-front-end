<?php
/**
 * Processes request to add partner
 */

if( Auth::isAuthenticated() ) {
    Util::getTemplate( 'index.php' );
    return;
}

//ensure we have a request to create
if( !isset( 
    $_REQUEST['partnerName'],
    $_REQUEST['contactName'],
    $_REQUEST['email'],
    $_REQUEST['password'],
    $_REQUEST['phone'],
    $_REQUEST['line1'],
    $_REQUEST['line2'],
    $_REQUEST['line3'],
    $_REQUEST['city'],
    $_REQUEST['state'],
    $_REQUEST['country'],
    $_REQUEST['zip']
) ) {
    Util::getTemplate( 'partner.create.php' );
    return;
}


$lsm = new LsmCurl;
$lsm->setEndpoint( LSM_API_ENDPOINT . "partner" );
$lsm->usePut();

//build the request
$partner = new StdClass;
$partner->email = $_REQUEST['email'];
$partner->phone = $_REQUEST['phone'];
$partner->contactName = $_REQUEST['contactName'];
$partner->partnerName = $_REQUEST['partnerName'];
$partner->password = md5( $_REQUEST['password'] );
$partner->line1 = $_REQUEST['line1'];
$partner->line2 = $_REQUEST['line2'];
$partner->line3 = $_REQUEST['line3'];
$partner->city = $_REQUEST['city'];
$partner->state = $_REQUEST['state'];
$partner->country = $_REQUEST['country'];
$partner->zip = $_REQUEST['zip'];

//hard code the values -- we would do this differently if we were fully implementing partners and taxonomies
$partner->isActive = true;

$lsm->setParameters( $partner );

//send the request
$lsm->sendRequest();

Util::getHeader();

$response = $lsm->getResponseContent();
$status = (int) $lsm->getResponseStatus();
if( !$response || $status < 200 || $status > 204 || @!$response->isSuccess ) {
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

if( DEBUG_API_CALLS )
    echo "<pre class='debug'>"; var_dump( $response ); echo"</pre>";
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Successfully Registered</h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <a class='btn btn-default' href="<?=SITE_URI?>login">Log in</a>
    </div>
</div>

<?php
Util::getFooter();