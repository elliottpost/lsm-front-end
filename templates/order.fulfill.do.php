<?php
/**
 * Processes a request to fulfill an order
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//force a search query
if( !isset( $_REQUEST['q'] ) || empty( $_REQUEST['q'] ) ) {
    Util::getTemplate( 'index.php' );
    return;
}

//ensure the user has verfied they want to ship the order
if( !isset( $_REQUEST['verified'] ) || (int) $_REQUEST['verified'] != 1 ) {
    Util::getTemplate( 'order.detail.php' ); 
    return;
}

//first get an order representation
$orderRepEntry = LSM_API_ENDPOINT . "order/" . $_REQUEST['q'] ;
$orderRepLsm = new LsmCurl;
$orderRepLsm->setEndpoint( $orderRepEntry );
$orderRepLsm->useGet();
$orderRepLsm->sendRequest();

$order = $orderRepLsm->getResponseContent();
if( !$order || (int) $orderRepLsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

//parse entry
if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "order/fulfill";

//ensure we have a request to create
$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->usePost();

//send the request
$lsm->setParameters( $order );
$lsm->sendRequest();

$response = $lsm->getResponseContent();
$status = (int) $lsm->getResponseStatus();
if( !$response || $status < 200 || $status > 204 || @!$response->isSuccess ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();

if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $response ); echo"</pre>";
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Order Successfully Marked As Delivered</h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <?php 
        //force our system to use the current product ID as the product ID in question
        $response->orderID = (int) $_REQUEST['q'];
        echo ApiLinks::linksToHtml( $response );
        ?>
    </div>
</div>

<?php
Util::getFooter();