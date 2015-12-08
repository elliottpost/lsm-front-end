<?php
/**
 * processes a delete request for partner
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

//ensure the user has verfied they want to delete the partner
if( !isset( $_REQUEST['verified'] ) || (int) $_REQUEST['verified'] != 1 ) {
    Util::getTemplate( 'partner.detail.php' ); 
    return;
}

if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "partner/" . $_REQUEST['q'] ;


$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->useDelete();
$lsm->sendRequest();

Util::getHeader();

$response = $lsm->getResponseContent();
if( !$response || (int) $lsm->getResponseStatus() != 200 || @!$response->isSuccess ) {
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

if( DEBUG_API_CALLS )
    echo "<pre class='debug'>"; var_dump( $response ); echo"</pre>";


Util::getHeader();
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">partner (Soft) Deleted Successfully</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php 
        echo ApiLinks::linksToHtml( $response );
        ?>
    </div>
</div>
<?php
Util::getFooter();