<?php
/**
 * Works with HATEOAS links from the API
 * @author Elliott Post
 */

abstract class ApiLinks implements I_ApiLinks {

	public static function linksToHtml( &$response ) {
		ob_start();
		foreach( $response->link as $link ) {

            $internalLink = SITE_URI;
            $entry = static::encodeHateoasLink( $link->url );
            switch( $link->action ):
                case "Check Product Availability":
                    $internalLink .= "product/availability/q/{$response->productID}?entry={$entry}";
                    break;

                case "Create Product Review":
                    $internalLink .= "reviews/product/new/q/{$response->productID}?entry={$entry}";
                    break;

                case "Get Product Reviews":
                    $internalLink .= "reviews/product/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Buy Product":
                    //@todo 
                    $internalLink .= "product/order/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Get Product Details":
                    //@todo 
                    $internalLink .= "product/detail/q/{$response->productID}?entry={$entry}";
                    break; 

                default:
                    //unknown link, our system can't handle that. just skip it
                    continue;
            endswitch;
            ?>
            <div class="form-group">
                <a 
                    class="btn btn-default" 
                    href="<?=$internalLink?>"
                    ><?=$link->action?> <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            <?php
        }
        return ob_get_clean();
	} //linksToHtml

	public static function encodeHateoasLink( $link ) {
		return urlencode( base64_encode( $link ) );
	} //encodeHateoasLink

	public static function decodeHateoasLink( $link ) {
		return urldecode( base64_decode( $link ) );
	} //decodeHateoasLink	

} //ApiLinks