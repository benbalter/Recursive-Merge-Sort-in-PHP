/* 	Author: Benjamin J. Balter 
	Project: Reqursive Merge Sort API Example Front End
*/

jQuery(document).ready( function( $ ){

	//on input change, make the AJAX call
	$('#input').keyup( function() {
		
		//if the field is empty, just clear the output box
		if ( $('#input').val() == "" ) {
			$('#output').html('');
			return false;
		}
		
		//show the loader on a delay to prevent flickering
		var loader = window.setTimeout( "$( '.loader').removeClass('hidden');", 100 );
		
		//make the JSONP call
		$.ajax({
			url: 'api.php',
			dataType: 'jsonp',
			data: $('#input').serialize(),
			success: function( data ){
				
				//remove loader timeout and hide loader if shown
				clearTimeout( loader );
				$( '.loader').addClass('hidden');
				
				//take response and implode into output box
				$('#output').html( data.join(', ') );
				
			}, 
			error: function( data, status, error ) {
				
				//in case of timeout, etc. remove loader
				clearTimeout( loader );
				$( '.loader').addClass('hidden');
			
			}
		});
	});

	$('.api').click( function( event ) {
	
		var url = 'api.php?' + $('#input').serialize() + '&format=' + $(this).attr('id');
		
		if ( $(this).attr('id') == 'jsonp' )
			url += '&callback=' + prompt( 'Callback?' );

		$(location).attr('href', url );
		
		event.preventDefault();
		return false;
	});
}); 







