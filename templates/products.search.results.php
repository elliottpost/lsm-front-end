<?php
/**
 * Displays product search results
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

$lsm = new LsmCurl;
$lsm->setEndpoint( LSM_API_ENDPOINT . "products/" . $_REQUEST['q'] );
$lsm->useGet();
$lsm->sendRequest();

Util::getHeader();

?>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products
                <small>Showing products matching: <em><?=$_REQUEST['q']?></em></small>
            </h1>
        </div>
    </div>
    <!-- /.row -->
    
    <?php
    $products = $lsm->getResponseContent();

    if( (int) $lsm->getResponseStatus() != 200 ) {
        Util::getTemplate( '500.php' );
        Util::getFooter();
        return;
    }
    
    if( empty( $products ) ) {
        ?>
        <div class="row">
            <div class="col-md-12">No results found</div>
        </div>
        <?php
        Util::getFooter();
        return;
    }
    
    foreach( $products as $product ) {
        if( DEBUG_API_CALLS )
            echo "<pre class='debug'>"; var_dump( $product ); echo"</pre>";
        ?>
        <div class="row">
            <div class="col-md-7">
                <a href="<?=$product->link[0]->url?>">
                    <img class="img-responsive" src="http://placehold.it/700x300" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3><?=$product->productName;?></h3>
                <h4>$<?=money_format( '%i', $product->price );?></h4>
                <p><?=$product->description?></p>
                <?php 
                echo ApiLinks::linksToHtml( $product );
                ?>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <?php
    } //foreach products as product

Util::getFooter();