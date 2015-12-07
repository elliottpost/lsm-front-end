<?php
/**
 * Displays login form
 */

Util::getHeader();
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-4">
        <h1 class="page-header">Login</h1>
        <form role="login" action='<?=SITE_URI?>' method='post'>    
            <div class="form-group">
                <input class="form-control"  type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="do-authenticate" value="1">
                <button type='btn btn-primary'>Login</button>
            </div>            
        </form>
    </div>
</div>
<!-- /.row -->
<?php
Util::getFooter();