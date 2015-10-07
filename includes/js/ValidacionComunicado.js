jQuery(document).ready(function($) {
	////
jQuery('#publish').click(function(){
		$title_value = jQuery.trim(jQuery('#title').val());

var tituloTemp=jQuery.trim(jQuery('#title').val());
var data = {
		'action': 'my_action',
		'whatever': ajax_object.we_value,      // We pass php values differently!
		'titulo' :ajax_object.titulo+tituloTemp     // We pass php values differently!
	};

if (ajax_object.we_value==1) {
	alert('vale: 1 ');
	console.log(ajax_object.we_value);
};

		if($title_value == 0 && $title_value != " "|| ajax_object.we_value==1){
			alert('Please insert title');
			jQuery('.spinner').css("visibility", "hidden");
			jQuery('#title').focus();
			return false;
		}



	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		alert('Got this from the server: ' + response);
	});

	});
	// draft button validation
	jQuery('#save-post').click(function(){
		$title_value = jQuery.trim(jQuery('#title').val());
		if($title_value == 0 && $title_value != " "){
			alert('Please insert title');
			jQuery('.spinner').css("visibility", "hidden");
			jQuery('#title').focus();
			return false;
		}
	});
///\

});