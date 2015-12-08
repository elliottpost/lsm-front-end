<?php
/**
 * Form for creating a new partner
 */

//if user is already logged in, don't allow this template
if( Auth::isAuthenticated() ) {
    Util::getTemplate( 'index.php' );
    return;
}

Util::getHeader();
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Register as Partner</h1>

        <form role="search" action='<?=SITE_URI?>partner/create/do' method='post'> 

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Partner (Business) Name" name="partnerName" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Contact Name" name="contactName" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>

            <div class="form-group">
                <input type="tel" class="form-control" placeholder="Phone" name="phone" required>
            </div>            

            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" placeholder="Line 1" name="line1" required>
                <input type="text" class="form-control" placeholder="Line 2" name="line2">
                <input type="text" class="form-control" placeholder="Line 3" name="line3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="City" name="city">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="State/Region" name="state">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Country" name="country">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Postal Code" name="zip">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Register As Partner</button>
            </div>
        </form>
    </div>
</div>
<?php
Util::getFooter();