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

Util::getHeader();

$report = $lsm->getResponseContent();
if( !$report || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

if( DEBUG_API_CALLS )
    echo "<pre class='debug'>"; var_dump( $report ); echo"</pre>";

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Partner Report</h1>

            
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