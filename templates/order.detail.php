<?php
/**
 * Displays details about an order
 * @todo
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

//get order details
if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "order/" . $_REQUEST['q'] ;

$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->useGet();
$lsm->sendRequest();

$order = $lsm->getResponseContent();
if( !$order || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getHeader();
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

//get product details
$productEntry = LSM_API_ENDPOINT . "product-by-id/" . $order->productID;

$productLsm = new LsmCurl;
$productLsm->setEndpoint( $productEntry );
$productLsm->useGet();
$productLsm->sendRequest();
$product = $productLsm->getResponseContent();

if( !$product || (int) $productLsm->getResponseStatus() != 200 ) {
    Util::getHeader();
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

Util::getHeader();
if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $order ); echo"</pre>";
    echo "<pre class='debug'>"; var_dump( $product ); echo"</pre>";
}

//get the order status
switch( $order->orderStatusCode ) {
    case 0:
        $percent = 100;
        $statusClass = "warning";
        $orderStatus = "Cancelled";
        break;

    case 1:
    default:
        $percent = 40;
        $statusClass = "primary";
        $orderStatus = "In Progress";
        break;

    case 2:
        $percent = 80;
        $statusClass = "primary";
        $orderStatus = "Shipped";
        break;

    case 3:
        $percent = 100;
        $statusClass = "success";
        $orderStatus = "Delivered";
        break;
}

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Order Details <small>Order Number <?=$order->orderID?></small></h1>

        <div class="progress">
            <div class="progress-bar progress-bar-<?=$statusClass?>" role="progressbar" style="width: <?=$percent?>%;">
                <strong><?=$orderStatus?></strong>
            </div>
        </div>
    </div>  
</div>

<div class="row">
    <div class="col-md-7">
        <p><img class="img-responsive" src="http://placehold.it/700x300" alt=""></p>
    </div>
    <div class="col-md-5">
        <h3><a href="<?=SITE_URI?>product/detail/q/<?=$product->productID?>"><?=$product->productName?></a> <small>$<?=money_format( '%i', $product->price );?></small></h3>
        <p><?=$product->description?></p>        
        <p><strong>Ordered:</strong> <?=date("Y/d/m H:i:s", $order->datePurchased);?></p>
        <?php
        if( $order->dateRefunded ):
            ?>
            <p><strong>Refunded:</strong> <?=date("Y/d/m H:i:s", $order->dateRefunded);?></p>
            <?php
        endif;

        if( $orderStatus == "Shipped" ):
            ?>
            <p><strong>Tracking Number:</strong> <?=$order->trackingNumber?></p>
            <?php
        endif;
        ?>

        <?php 
        echo ApiLinks::linksToHtml( $order );
        ?>        
    </div>
</div>  

<?php
Util::getFooter();