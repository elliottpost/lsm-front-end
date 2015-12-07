<?php
/**
 * Displays login form
 */
if( Auth::isAuthenticated() ) {
    Util::getTemplate( 'index.php' );
    return;
}


Util::getHeader();
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-4">
        <h1 class="page-header">Login</h1>

        <?php
        if( isset( $GLOBALS['error'] ) ):
            global $error;
            ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?=$error?>
            </div>        
            <?php
        endif;
        ?>

        <form role="login" action='<?=SITE_URI?>login/do' method='post'>    
            <div class="form-group">
                <input class="form-control"  type="email" name="email" placeholder="Email" value="<?=(isset( $_REQUEST['email'] ) ? $_REQUEST['email'] : null)?>" required>
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