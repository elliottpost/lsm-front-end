<?php
//force a search query
if( !isset( $_REQUEST['q'], $_REQUEST['entry'] ) || empty( $_REQUEST['q'] ) || empty( $_REQUEST['entry'] ) ) {
    Util::getTemplate( 'products.search.php' );
    return;
}

$lsm = new LsmCurl;
$lsm->setEndpoint( Util::decodeHateoasLink( $_REQUEST['entry'] ) );
$lsm->useGet();
$lsm->sendRequest();

Util::getHeader();

$product = json_decode( $lsm->getResponseContent() );
if( !$product || (int) $lsm->getResponseStatus() != 200 ) {
    Util::getTemplate( '500.php' );
    Util::getFooter();
    return;
}

if( DEBUG_API_CALLS )
    echo "<pre>"; var_dump( $product ); echo"</pre>";

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$product->productName?> <small>$<?=money_format( '%i', $product->price );?></small></h1>
        <p><?=$product->description?></p>
    </div>

        <div class="row">
            <div class="col-md-7">
                <img class="img-responsive" src="http://placehold.it/700x300" alt="">
            </div>
            <div class="col-md-5">                
                <?php
                //parse and build the HATEOAS link buttons
                foreach( $product->link as $link ) {

                    $internalLink = SITE_URI;
                    $entry = Util::encodeHateoasLink( $link->url );
                    switch( $link->action ):
                        case "Check Product Availability":
                            $internalLink .= "product/availability/q/{$product->productID}?entry={$entry}";
                            break;

                        case "Create Product Review":
                            $internalLink .= "review/product/new/q/{$product->productID}?entry={$entry}";
                            break;

                        case "Get Product Reviews":
                            $internalLink .= "review/product/q/{$product->productID}?entry={$entry}";
                            break; 

                        case "Buy Product":
                            //@todo 
                            $internalLink .= "product/order/q/{$product->productID}?entry={$entry}";
                            break; 

                        default:
                            //unknown link, our system can't handle that. just skip it
                            continue;
                    endswitch;
                    ?>
                    <div class="form-group">
                        <a 
                            class="btn btn-primary" 
                            href="<?=$internalLink?>"
                            ><?=$link->action?> <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                    <?php
                }
                ?>                
            </div>
        </div>    
</div>
<!-- /.row -->

<?php
Util::getFooter();