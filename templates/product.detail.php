<?php
/**
 * Displays details about a product
 */

//force a search query
if( !isset( $_REQUEST['q'], $_REQUEST['entry'] ) || empty( $_REQUEST['q'] ) || empty( $_REQUEST['entry'] ) ) {
    Util::getTemplate( 'products.search.php' );
    return;
}

$lsm = new LsmCurl;
$lsm->setEndpoint( ApiLinks::decodeHateoasLink( $_REQUEST['entry'] ) );
$lsm->useGet();
$lsm->sendRequest();

Util::getHeader();

$product = json_decode( $lsm->getResponseContent() );
if( !$product || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

if( DEBUG_API_CALLS )
    echo "<pre>"; var_dump( $product ); echo"</pre>";

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