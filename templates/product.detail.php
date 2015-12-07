<?php
/**
 * Displays details about a product
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
    $entry = LSM_API_ENDPOINT . "product-by-id/" . $_REQUEST['q'] ;

$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->useGet();
$lsm->sendRequest();

Util::getHeader();

$product = $lsm->getResponseContent();
if( !$product || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

if( DEBUG_API_CALLS )
    echo "<pre class='debug'>"; var_dump( $product ); echo"</pre>";

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$product->productName?> <small>$<?=money_format( '%i', $product->price );?></small></h1>
        <p><?=$product->description?></p>
    </div>  
</div>

 <div class="row">
    <div class="col-md-7">
        <img class="img-responsive" src="http://placehold.it/700x300" alt="">
    </div>
    <div class="col-md-5">
        <?php 
        echo ApiLinks::linksToHtml( $product );
        ?>
    </div>
</div>  

<?php
Util::getFooter();