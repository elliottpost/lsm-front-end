jQuery(document).ready(function($){
	$(document).on('click', ".confirm-delete", function(e){		
		var data = $(this).data();
		console.log( "confirm delete request recieved for method " + data.method );
		switch( data.method ) {
			case "delete-customer":
				confirmDeleteCustomer( $(this) );
				break;

			case "delete-partner":
				confirmDeletePartner( $(this) );
				break;

			case "cancel-order":
				confirmCancelOrder( $(this) );
				break;

			default:
				//unknown case, perform original link URI
				return;
				break;
		}

		//needs to be at the end of the function
		e.preventDefault();
	});

	/**
	 * Listen for changes to review form toggles
	 */
    //force an integer between 1-10
    $('#rating').on( "change", function(){
    	$(this).val( Math.floor( $(this).val() ) );
        if( $(this).val() < 1 )
            $(this).val( 1 );
		else if( $(this).val() > 10 )
			$(this).val( 10 );
    });

    //keep the slider and numbers in sync
    $("#rating").on( "change", function(){
        $( "#rating-num" ).text( $(this).val() );
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

/**
 * @see https://nakupanda.github.io/bootstrap3-dialog/
 */
 function confirmDeletePartner( $that ) {
 	var $ = jQuery;

	BootstrapDialog.confirm({
		title: 'Confirm',
		message: 'Perform soft delete on selected partner?',
		type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
		closable: true, // <-- Default value is false
		draggable: true, // <-- Default value is false
		btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
		btnOKLabel: 'Soft Delete Partner', // <-- Default value is 'OK',
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

/**
 * @see https://nakupanda.github.io/bootstrap3-dialog/
 */
 function confirmCancelOrder( $that ) {
 	var $ = jQuery;

	BootstrapDialog.confirm({
		title: 'Confirm',
		message: 'Cancel order?',
		type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
		closable: true, // <-- Default value is false
		draggable: true, // <-- Default value is false
		btnCancelLabel: 'Do Not Cancel Order', // <-- Default value is 'Cancel',
		btnOKLabel: 'Cancel Order', // <-- Default value is 'OK',
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