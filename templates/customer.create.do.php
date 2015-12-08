<?php
/**
 * processes a request for creating a customer
 */

if( Auth::isAuthenticated() ) {
    Util::getTemplate( 'index.php' );
    return;
}

//ensure we have a request to create
if( !isset( 
    $_REQUEST['title'], 
    $_REQUEST['firstName'],
    $_REQUEST['lastName'],
    $_REQUEST['email'],
    $_REQUEST['password'],
    $_REQUEST['phone'],
    $_REQUEST['shippingAddressLine1'],
    $_REQUEST['shippingAddressLine2'],
    $_REQUEST['shippingAddressLine3'],
    $_REQUEST['shippingAddressCity'],
    $_REQUEST['shippingAddressState'],
    $_REQUEST['shippingAddressCountry'],
    $_REQUEST['shippingAddressZip'],
    $_REQUEST['billingAddressLine1'],
    $_REQUEST['billingAddressLine2'],
    $_REQUEST['billingAddressLine3'],
    $_REQUEST['billingAddressCity'],
    $_REQUEST['billingAddressState'],
    $_REQUEST['billingAddressCountry'],
    $_REQUEST['billingAddressZip']
) ) {
    Util::getTemplate( 'customer.create.php' );
    return;
}


$lsm = new LsmCurl;
$lsm->setEndpoint( LSM_API_ENDPOINT . "customer" );
$lsm->usePut();

//build the request
$customer = new StdClass;
$customer->email = $_REQUEST['email'];
$customer->phone = $_REQUEST['phone'];
$customer->title = $_REQUEST['title'];
$customer->firstName = $_REQUEST['firstName'];
$customer->lastName = $_REQUEST['lastName'];
$customer->password = md5( $_REQUEST['password'] );
$customer->shippingAddressLine1 = $_REQUEST['billingAddressLine1'];
$customer->shippingAddressLine2 = $_REQUEST['shippingAddressLine2'];
$customer->shippingAddressLine3 = $_REQUEST['shippingAddressLine3'];
$customer->shippingAddressCity = $_REQUEST['shippingAddressCity'];
$customer->shippingAddressState = $_REQUEST['shippingAddressState'];
$customer->shippingAddressCountry = $_REQUEST['shippingAddressCountry'];
$customer->shippingAddressZip = $_REQUEST['shippingAddressZip'];
$customer->billingAddressLine1 = $_REQUEST['billingAddressLine1'];
$customer->billingAddressLine2 = $_REQUEST['billingAddressLine2'];
$customer->billingAddressLine3 = $_REQUEST['billingAddressLine3'];
$customer->billingAddressCity = $_REQUEST['billingAddressCity'];
$customer->billingAddressState = $_REQUEST['billingAddressState'];
$customer->billingAddressCountry = $_REQUEST['billingAddressCountry'];
$customer->billingAddressZip = $_REQUEST['billingAddressZip'];

//hard code the values -- we would do this differently if we were fully implementing partners and taxonomies
$customer->paypalCustID = 123456789;

$lsm->setParameters( $customer );

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