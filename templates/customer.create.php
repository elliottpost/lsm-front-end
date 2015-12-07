<?php
/**
 * Form for creating a new customer
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
        <h1 class="page-header">Register as Customer</h1>

        <form role="search" action='<?=SITE_URI?>customer/create/do' method='post'> 
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" name="title" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="First Name" name="firstName" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
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
                <label>Shipping Address:</label>
                <input type="text" class="form-control" placeholder="Line 1" name="shippingAddressLine1" required>
                <input type="text" class="form-control" placeholder="Line 2" name="shippingAddressLine2">
                <input type="text" class="form-control" placeholder="Line 3" name="shippingAddressLine3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="City" name="shippingAddressCity">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="State/Region" name="shippingAddressState">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Country" name="shippingAddressCountry">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Postal Code" name="shippingAddressZip">
                    </div>
                </div>
            </div>  

            <div class="form-group">
                <label>Billing Address:</label>
                <input type="text" class="form-control" placeholder="Line 1" name="billingAddressLine1" required>
                <input type="text" class="form-control" placeholder="Line 2" name="billingAddressLine2">
                <input type="text" class="form-control" placeholder="Line 3" name="billingAddressLine3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="City" name="billingAddressCity">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="State/Region" name="billingAddressState">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Country" name="billingAddressCountry">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Postal Code" name="billingAddressZip">
                    </div>
                </div>
            </div>              
            

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Register As Customer</button>
            </div>
        </form>
    </div>
</div>
<?php
Util::getFooter();