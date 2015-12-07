<?php
/**
 * Form for creating a new product
 */

if( !Auth::isAuthenticated() ) {
    Util::getTemplate( 'login.php' );
    return;
}

Util::getHeader();
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create new product</h1>
        <form role="search" action='<?=SITE_URI?>product/create/do' method='post'> 
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="productName" required>
            </div>

            <div class="form-group">
                <textarea class="form-control" rows="5" cols="50" placeholder="Name" name="description" required></textarea>
            </div>            

            <div class="form-group">
                <input type="number" min="0" step="1" class="form-control" placeholder="Cost (Enter 7 for $7.00)" name="cost" required>
            </div>

            <div class="form-group">
                <input type="number" min="0" step="1" class="form-control" placeholder="Price (Enter 7 for $7.00)" name="price" required>
            </div>

            <div class="form-group">
                <input type="number" min="0" step="1" class="form-control" placeholder="Quantity On Hand" name="qoh" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Create Product</button>
            </div>
        </form>
    </div>
</div>
<?php
Util::getFooter();