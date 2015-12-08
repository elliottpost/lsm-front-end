<?php
/**
 * Processes a request to order a roduct
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//force a search query
if( !isset( $_REQUEST['q'] ) || empty( $_REQUEST['q'] ) ) {
    Util::getTemplate( 'products.search.php' );
    return;
}

if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "order";

$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->usePut();

//build the request
$order = new StdClass;
$order->productID = $_REQUEST['q'];
$order->quantity = 1;
$order->customerID = Auth::getCustomerId();

$lsm->setParameters( $order );
$lsm->sendRequest();

$order = $lsm->getResponseContent();
if( !$order || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();
if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $order ); echo"</pre>";
}

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Order Placed Successfully</h1>
    </div>  
</div>

 <div class="row">
    <div class="col-md-12">
        <?php
        $order->orderID = (int) $order->genericReturnValue;
        echo ApiLinks::linksToHtml( $order );
        ?>
    </div>
</div>  

<?php
Util::getFooter();