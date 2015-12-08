<?php
/**
 * Works with HATEOAS links from the API
 * @author Elliott Post
 */

abstract class ApiLinks implements I_ApiLinks {

	public static function linksToHtml( &$response ) {

        if( !isset( $response->link ) || empty( $response->link ) || !is_array( $response->link ) )
            return;

		ob_start();
		foreach( $response->link as $link ) {

            $internalLink = SITE_URI;
            $entry = static::encodeHateoasLink( $link->url );
            $class = null;
            $resourceId = null;
            $data['method'] = null;
            switch( $link->action ):
                case "Check Product Availability":
                    $data['method'] = 'check-product-availability';
                    $resourceId = $response->productID;
                    $internalLink .= "product/availability/q/{$response->productID}?entry={$entry}";
                    break;

                case "Create Product Review":
                    $data['method'] = 'create-product-review';
                    $resourceId = $response->productID;
                    $internalLink .= "reviews/product/new/q/{$response->productID}?entry={$entry}";
                    break;

                case "Get Product Reviews":
                    $data['method'] = 'get-product-reviews';
                    $resourceId = $response->productID;
                    $internalLink .= "reviews/product/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Buy Product":
                    //@todo 
                    $data['method'] = 'buy-product';
                    $resourceId = $response->productID;
                    $internalLink .= "product/order/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Get Product Details":
                    $data['method'] = 'get-product-details';
                    $resourceId = $response->productID;
                    $internalLink .= "product/detail/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Delete Customer":
                    $data['method'] = 'delete-customer';
                    $class = 'confirm-delete btn-danger';
                    $resourceId = $response->customerId;
                    $internalLink .= "customer/delete/do/q/{$response->customerId}?entry={$entry}&verified=1";
                    break; 

                default:
                    //unknown link, our system can't handle that. just skip it
                    continue;
            endswitch;
            ?>
            <div class="form-group">
                <a 
                    class="btn btn-default <?=$class?>"
                    data-method="<?=$data['method']?>"
                    data-resource-id="<?=$resourceId?>"
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