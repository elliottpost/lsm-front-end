<?php
/**
 * Form for creating a new product
 */

Util::getHeader();
?>
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