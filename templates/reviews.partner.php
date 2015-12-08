<?php
/**
 * @todo
 * This template is used for viewing a partner review
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//ensure we know what we're creating a review for
if( !isset( $_REQUEST['q'], $_REQUEST['entry'] ) || empty( $_REQUEST['q'] ) || empty( $_REQUEST['entry'] ) ) {
    Util::getTemplate( 'partners.search.php' );
    return;
}

$lsm = new LsmCurl;
$lsm->setEndpoint( ApiLinks::decodeHateoasLink( $_REQUEST['entry'] ) );
$lsm->useGet();
$lsm->sendRequest();


$reviews = $lsm->getResponseContent();
if( (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    return;
}

Util::getHeader();
if( DEBUG_API_CALLS ) {
    echo "<pre class='debug'>"; var_dump( $reviews ); echo"</pre>";
}

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Partner Reviews</h1>
    </div>
</div>

<?php 
if( empty( $reviews ) ) {
    ?>
    <div class="row">
        <div class="col-lg-12">
            No Partner Reviews Found
        </div>
    </div>    
    <?php
} else {
    echo "<div class='row'>";
    foreach( $reviews as $review ):
        ?>
        <div class="col-md-4">
            <p><strong>Review Date: </strong> <?=date("Y/d/m H:i:s", $review->reviewDate);?></p>
            <p><strong>Rating: </strong> <?=$review->rating?>/10</p>
            <p><strong>Comments: </strong> <?=htmlspecialchars( $review->review )?></p>

            <?php 
            echo ApiLinks::linksToHtml( $review );
            ?>                
        </div>
        <?php
    endforeach;
    echo "<div class='clearfix'></div></div>";
}

Util::getFooter();