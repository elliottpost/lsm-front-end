<?php
//force a search query
if( !isset( $_REQUEST['q'] ) || empty( $_REQUEST['q'] ) ) {
    Util::getTemplate( 'index.php' );
    return;
}

$lsm = new LsmCurl( true );
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

    <!-- Project One -->
    <?php
    $products = json_decode( $lsm->getResponseContent() );
    if( $products ) {
        foreach( $products as $product ) {
            ?>
            <div class="row">
                <div class="col-md-7">
                    <a href="#">
                        <img class="img-responsive" src="http://placehold.it/700x300" alt="">
                    </a>
                </div>
                <div class="col-md-5">
                    <h3><?=$product->productName;?></h3>
                    <h4>$<?=money_format( '%i', $product->price );?></h4>
                    <p><?=$product->description?></p>
                    <a class="btn btn-primary" href="#">Buy Product <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
            <!-- /.row -->

            <hr>

            <?php
        } //foreach products as product
    } //has products

Util::getFooter();