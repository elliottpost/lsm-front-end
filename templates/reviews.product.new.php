<?php
/**
 * @todo
 * This template is used for creating a new review
 */

//ensure we know what we're creating a review for
if( !isset( $_REQUEST['q'], $_REQUEST['entry'] ) || empty( $_REQUEST['q'] ) || empty( $_REQUEST['entry'] ) ) {
    Util::getTemplate( 'products.search.php' );
    return;
}

$lsm = new LsmCurl;
$lsm->setEndpoint( Util::decodeHateoasLink( $_REQUEST['entry'] ) );
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
<!-- /.row -->

<?php
Util::getFooter();