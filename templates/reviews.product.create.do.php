<?php
/**
 * Processes a request to review a product
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

//ensure we have a request to create
if( !isset( 
    $_REQUEST['rating'], 
    $_REQUEST['review']
) ) {
    Util::getTemplate( 'reviews.product.create.php' );
    return;
}


if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "review/product";

$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->usePut();

//build the request
$ProductReview = new StdClass;
$ProductReview->productID = (int) $_REQUEST['q'];
$ProductReview->rating = (int) $_REQUEST['rating'];
$ProductReview->review = $_REQUEST['review'];
$ProductReview->customerID = Auth::getCustomerId();

$lsm->setParameters( $ProductReview );
$lsm->sendRequest();

$review = $lsm->getResponseContent();
if( !$review || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();
if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $review ); echo"</pre>";
}

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Review Created Successfully</h1>
    </div>  
</div>

 <div class="row">
    <div class="col-md-12">
        <?php
        $review->productID = $ProductReview->productID;
        echo ApiLinks::linksToHtml( $review );
        ?>
    </div>
</div>  

<?php
Util::getFooter();