<?php
/**
 * This template is entry point for the API
 */

Util::getHeader();
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Search for products</h1>
        <form role="search" action='<?=SITE_URI?>products/search/results' method='post'>    
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Products" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- /.row -->
<?php
Util::getFooter();