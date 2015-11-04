<?php
//force a search query
if( !isset( $_REQUEST['q'] ) || empty( $_REQUEST['q'] ) ) {
    require_once 'index.php';
    return;
}

require_once 'head.php';
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
        $ch = curl_init();        
        $url = "http://lsm1.herokuapp.com/services/lsm/products/es";
        curl_setopt( $ch, CURLOPT_URL, $url );
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';

        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_HTTPGET, true );
        ob_start();
        curl_exec( $ch );
        $products = json_decode( ob_get_clean() );

        //close connection
        curl_close( $ch );
        // echo "<pre>";var_dump( $products );die();
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
 
require_once 'foot.php';