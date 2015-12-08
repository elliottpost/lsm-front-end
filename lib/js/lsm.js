jQuery(document).ready(function($){
	$(document).on('click', ".confirm-delete", function(e){		
		var data = $(this).data();
		console.log( "confirm delete request recieved for method " + data.method );
		switch( data.method ) {
			case "delete-customer":
				confirmDeleteCustomer( $(this) );
				break;

			default:
				//unknown case, perform original link URI
				return;
				break;
		}

		//needs to be at the end of the function
		e.preventDefault();
	});
});

/**
 * @see https://nakupanda.github.io/bootstrap3-dialog/
 */
 function confirmDeleteCustomer( $that ) {
 	var $ = jQuery;

	BootstrapDialog.confirm({
		title: 'Confirm',
		message: 'Perform soft delete on selected customer?',
		type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
		closable: true, // <-- Default value is false
		draggable: true, // <-- Default value is false
		btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
		btnOKLabel: 'Soft Delete Customer', // <-- Default value is 'OK',
		btnOKClass: 'btn-danger', // <-- If you didn't specify it, dialog type will be used,
		callback: function(result) {
		    // result will be true if button was click, while it will be false if users close the dialog directly.
		    if( result ) {
		        window.location.href = $that.attr('href');
		    } else {
		        //do nothing
		    }
		}
	});
}