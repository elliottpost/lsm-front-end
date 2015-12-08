<?php
/**
 * Processes a request to create a new product
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//ensure we have a request to create
if( !isset( 
    $_REQUEST['productName'], 
    $_REQUEST['description'],
    $_REQUEST['cost'],
    $_REQUEST['price'],
    $_REQUEST['qoh']
) ) {
    Util::getTemplate( 'product.create.php' );
    return;
}


$lsm = new LsmCurl;
$lsm->setEndpoint( LSM_API_ENDPOINT . "product" );
$lsm->usePut();

//build the request
$product = new StdClass;
$product->isActive = true;
$product->productName = $_REQUEST['productName'];
$product->description = $_REQUEST['description'];
$product->price = (float) $_REQUEST['price'];
$product->cost = (float) $_REQUEST['cost'];
$product->qoh = (int) $_REQUEST['qoh'];

//hard code the values -- we would do this differently if we were fully implementing partners and taxonomies
$product->partnerID = 1;
$product->taxonomyID = 2;

$lsm->setParameters( $product );

//send the request
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
        <h1 class="page-header">Product <em><?=$_REQUEST['productName']?></em> Successfully Created</h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <?php 
        //force our system to use the current product ID as the product ID in question
        $response->productID = (int) $response->genericReturnValue;
        echo ApiLinks::linksToHtml( $response );
        ?>
    </div>
</div>

<?php
Util::getFooter();