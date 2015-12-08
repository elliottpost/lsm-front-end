<?php
/**
 * Processes a request to review a partner
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//force a search query
if( !isset( $_REQUEST['q'] ) || empty( $_REQUEST['q'] ) ) {
    Util::getTemplate( 'partners.search.php' );
    return;
}

//ensure we have a request to create
if( !isset( 
    $_REQUEST['rating'], 
    $_REQUEST['review']
) ) {
    Util::getTemplate( 'reviews.partner.create.php' );
    return;
}


if( isset( $_REQUEST['entry'] ) )
    $entry = ApiLinks::decodeHateoasLink( $_REQUEST['entry'] );
else
    $entry = LSM_API_ENDPOINT . "review/partner";

$lsm = new LsmCurl;
$lsm->setEndpoint( $entry );
$lsm->usePut();

//build the request
$PartnerReview = new StdClass;
$PartnerReview->partnerID = (int) $_REQUEST['q'];
$PartnerReview->rating = (int) $_REQUEST['rating'];
$PartnerReview->review = $_REQUEST['review'];
$PartnerReview->customerID = Auth::getCustomerId();

$lsm->setParameters( $PartnerReview );
$lsm->sendRequest();

$review = $lsm->getResponseContent();
if( !$review || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();
if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $review ); echo"</pre>";
}

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Review Created Successfully</h1>
    </div>  
</div>

 <div class="row">
    <div class="col-md-12">
        <?php
        $review->partnerID = $PartnerReview->partnerID;
        echo ApiLinks::linksToHtml( $review );
        ?>
    </div>
</div>  

<?php
Util::getFooter();