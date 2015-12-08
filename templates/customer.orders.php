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
    $entry = LSM_API_ENDPOINT . "customer/orders/" . $_REQUEST['q'] ;

$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->useGet();
$lsm->sendRequest();

$orders = $lsm->getResponseContent();
if( !$orders || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();
?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Customer Order History</h1>
        <p>Showing all orders</p>
    </div>  
</div>

<?php
foreach( $orders as $order ):
    if( DEBUG_API_CALLS ) {
        echo "<pre class='debug'>"; var_dump( $order ); echo"</pre>";
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

    <div class="row">
        <div class="col-md-12">
            <h3>Order <?=$order->orderID?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="progress">
                <div class="progress-bar progress-bar-<?=$statusClass?>" role="progressbar" style="width: <?=$percent?>%;">
                    <strong><?=$orderStatus?></strong>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
endforeach;

Util::getFooter();