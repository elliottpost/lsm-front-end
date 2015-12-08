<?php
/**
 * This template is used for creating a new review
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

//ensure we know what we're creating a review for
if( !isset( $_REQUEST['q'] ) ||  empty( $_REQUEST['q'] ) ) {
    Util::getTemplate( 'partners.search.php' );
    return;
}

Util::getHeader();
?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Review Partner</h1>
    </div>
</div>
<form action='<?=SITE_URI?>reviews/partner/create/do' method='post'> 
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Rating</span>
                    <input type="range" class="form-control" name="rating" id="rating" min="1" max="10" step="1" value="0" required>
                    <span class="input-group-addon"><span id="rating-num"></span>/10</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" rows="5" cols="50" placeholder="Comments" name="review" required></textarea>
            </div>

            <div class="form-group">
                <input type="hidden" name="partnerID" value="<?=$_REQUEST['q']?>">
                <input type="hidden" name="q" value="<?=$_REQUEST['q']?>">
                <button class="btn btn-primary" type="submit">Review Partner</button>
            </div>
        </div>
    </div>
</form>

<?php
Util::getFooter();