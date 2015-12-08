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

                #----------
                # Products
                #----------

                case "Check Product Availability":
                    $data['method'] = 'check-product-availability';
                    $class = 'confirm-delete btn-primary';
                    $resourceId = $response->productID;
                    $internalLink .= "product/availability/q/{$response->productID}?entry={$entry}";
                    break;

                case "Create Product Review":
                    $data['method'] = 'create-product-review';
                    $class = 'btn-primary';
                    $resourceId = $response->productID;
                    $internalLink .= "reviews/product/new/q/{$response->productID}?entry={$entry}";
                    break;

                case "Get Product Reviews":
                    $data['method'] = 'get-product-reviews';
                    $class = 'btn-primary';
                    $resourceId = $response->productID;
                    $internalLink .= "reviews/product/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Buy Product":
                    $data['method'] = 'buy-product';
                    $class = 'btn-primary';
                    $resourceId = $response->productID;
                    $internalLink .= "product/order/do/q/{$response->productID}?entry={$entry}";
                    break; 

                case "Get Product Details":
                    $data['method'] = 'get-product-details';
                    $class = 'btn-primary';
                    $resourceId = $response->productID;
                    $internalLink .= "product/detail/q/{$response->productID}?entry={$entry}";
                    break; 



                #----------
                # Customers
                #----------

                case "Delete Customer":
                    $data['method'] = 'delete-customer';
                    $class = 'confirm-delete btn-danger';
                    $resourceId = $response->customerID;
                    $internalLink .= "customer/delete/do/q/{$response->customerID}?entry={$entry}&verified=1";
                    break; 




                #----------
                # Partners
                #----------
                case "Delete Partner":
                    $data['method'] = 'delete-partner';
                    $class = 'confirm-delete btn-danger';
                    $resourceId = $response->partnerID;
                    $internalLink .= "partner/delete/do/q/{$response->partnerID}?entry={$entry}&verified=1";
                    break; 

                case "Generate Report":
                    $data['method'] = 'generate-partner-report';
                    $class = 'btn-primary';
                    $resourceId = $response->partnerID;
                    $internalLink .= "partner/report/q/{$response->partnerID}?entry={$entry}";
                    break;


                #----------
                # Orders
                #----------
                case "Get Order Details":
                    $data['method'] = 'get-order-details';
                    $class = 'btn-primary';
                    $resourceId = $response->orderID;
                    $internalLink .= "order/detail/q/{$response->orderID}?entry={$entry}";
                    break;

                case "Cancel Order":
                    $data['method'] = 'cancel-order';
                    $class = "confirm-delete btn-danger";
                    $resourceId = $response->orderID;
                    $internalLink .= "order/cancel/do/q/{$response->orderID}?entry={$entry}&verified=1";
                    break; 

                case "Ship Order":
                    //@todo
                    $data['method'] = 'ship-order';
                    $class = 'btn-primary';
                    $resourceId = $response->orderID;
                    $internalLink .= "order/ship/do/q/{$response->orderID}?entry={$entry}&verified=1";
                    break; 

                case "Fulfill Order":
                    //@todo
                    $data['method'] = 'fulfill-order';
                    $class = 'btn-primary';
                    $resourceId = $response->orderID;
                    $internalLink .= "order/fulfill/do/q/{$response->orderID}?entry={$entry}&verified=1";
                    break; 

                default:
                    //unknown link, our system can't handle that. just print normal
                    break;
            endswitch;
            ?>
            <div class="form-group">
                <a 
                    class="btn <?=$class?>"
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