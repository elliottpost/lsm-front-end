<?php
/**
 * Checks product availability
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

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
        <h1 class="page-header"><?=$response->message?></h1>
    </div> 
</div>

<div class="row">
    <div class="col-lg-12">
        <?php 
        //force our system to use the current product ID as the product ID in question
        $response->productID = (int) $_GET['q'];
        echo ApiLinks::linksToHtml( $response );
        ?>
    </div>
</div>

<?php
Util::getFooter();