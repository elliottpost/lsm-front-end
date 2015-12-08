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
    $entry = LSM_API_ENDPOINT . "partner/" . $_REQUEST['q'] ;


$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->useGet();
$lsm->sendRequest();

$partner = $lsm->getResponseContent();
if( !$partner || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();
if( DEBUG_API_CALLS )
    echo "<pre class='debug'>"; var_dump( $partner ); echo"</pre>";



?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Partner Details</h1>

            <div class="form-group">
                <label><input type="checkbox" name="isActive" <?php if( $partner->isActive) echo 'checked'; ?> disabled> Active User (Not Soft Deleted)</label>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Partner (Business) Name" name="partnerName" disabled value="<?=$partner->partnerName?>">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Contact Name" name="contactName" disabled value="<?=$partner->contactName?>">
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" disabled value="<?=$partner->email?>">
            </div>

            <div class="form-group">
                <input type="tel" class="form-control" placeholder="Phone" name="phone" disabled value="<?=$partner->phone?>">
            </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php 
        echo ApiLinks::linksToHtml( $partner );
        ?>
    </div>
</div>

<?php
Util::getFooter();