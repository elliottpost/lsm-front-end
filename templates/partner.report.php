<?php
/**
 * Shows partner details
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//force a search query
if( !isset( $_REQUEST['q'] ) || empty( $_REQUEST['q'] ) ) {
    Util::getTemplate( 'index.php' ); //@todo change to partners.search.php if feature gets built
    return;
}

if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "report/" . $_REQUEST['q'] ;


$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->useGet();
$lsm->sendRequest();

$report = $lsm->getResponseContent();
if( (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();

if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $report ); echo"</pre>";
}

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Partner Sales Report <small>All Orders By Product ID</small></h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Prod ID</th>
                    <th>Qty</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Total Cost</th>
                    <th>Total Price</th>
                    <th>Total Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if( empty( $report ) ) {
                    ?>
                    <tr>
                        <td colspan="7">No records found</td>
                    </tr>
                    <?php
                } else {
                    foreach( $report as $row ) {
                        ?>
                        <tr>
                            <td><?=$row->productId?></td>
                            <td><?=$row->quantity?></td>
                            <td><?=$row->cost?></td>
                            <td><?=$row->price?></td>
                            <td><?=$row->totalCost?></td>
                            <td><?=$row->totalPrice?></td>
                            <td><?=$row->totalProfit?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Prod ID</th>
                    <th>Qty</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Total Cost</th>
                    <th>Total Price</th>
                    <th>Total Profit</th>
                </tr>
            </tfoot>            
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php 
        echo ApiLinks::linksToHtml( $report );
        ?>
    </div>
</div>

<?php
Util::getFooter();