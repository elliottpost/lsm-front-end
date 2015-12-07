<?php
/**
 * Form for creating a new product
 */

//ensure we have a request to create
if( !isset( 
    $_REQUEST['productName'], 
    $_REQUEST['description'],
    $_REQUEST['cost'],
    $_REQUEST['price'],
    $_REQUEST['qoh'],
 ) ) {
    Util::getTemplate( 'product.create.php' );
    return;
}


$lsm = new LsmCurl;
$lsm->setEndpoint( LSM_API_ENDPOINT . "product" );
$lsm->usePut();

//build the request
$product = new Object();
$product->isActive = true;
$product->productName = $_REQUEST['productName'];
$product->description = $_REQUEST['description'];
$product->price = (int) $_REQUEST['price'];
$product->cost = (int) $_REQUEST['cost'];
$product->qoh = (int) $_REQUEST['qoh'];

//hard code the values -- we would do this differently if we were fully implementing partners and taxonomies
$product->partnerID = 1;
$product->taxonomyID = 2;

//send the request
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

Util::getHeader();
?>

<Product>
<isActive>true</isActive>
<price>700</price>
<partnerID>1</partnerID>
<taxonomyID>2</taxonomyID>
<productName>Samsung Galaxy Note 3</productName>
<description>This is the best phone in the world</description>
<cost>400</cost>
<qoh>5000</qoh>
</Product>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create new product</h1>
        <form role="search" action='product/create/do' method='post'> 
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="productName">
            </div>

            <div class="form-group">
                <textarea class="form-control" rows="5" cols="50" placeholder="Name" name="description"></textarea>
            </div>            

            <div class="form-group">
                <input type="number" min="0" step="1" class="form-control" placeholder="Cost (Enter 700 for $7.00)" name="cost">
            </div>

            <div class="form-group">
                <input type="number" min="0" step="1" class="form-control" placeholder="Price (Enter 700 for $7.00)" name="price">
            </div>

            <div class="form-group">
                <input type="number" min="0" step="1" class="form-control" placeholder="Quantity On Hand" name="qoh">
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit"></button>
            </div>
        </form>
    </div>
</div>
<?php
Util::getFooter();