jQuery( document ).on( 'click', '#publish', function() {
	//var post_id = jQuery(this).data('id');
	var title_value = jQuery.trim(jQuery('#title').val());
	alert("Titulo "+title_value);
	var form_data = jQuery('#post').serializeArray();//Todo el post
	var flag = null;
	jQuery.ajax({
		url : ajax_object.ajax_url,
		type : 'post',
		data : {
			action : 'my_action',
			titulo : title_value,
			form_data: jQuery.param(form_data)
		},
		async:false,
		success : function( response ) {
				//alert("esto es el respose :"+response);
				if (response==1) {
					alert("response "+response);
					flag = true;
					//jQuery('.spinner').css("visibility", "hidden");
					jQuery('#title').focus();
				}
				if(response==0){
					alert("response "+response);
					flag = false;}
				//return false;
				//return false;
			//jQuery('#love-count').html( response );
		}
	});
	alert("Esto es flag: "+flag);
	return flag;
});
/*jQuery(document).ready(function($) {
	////
jQuery('#publish').click(function(){
		$title_value = jQuery.trim(jQuery('#title').val());

var tituloTemp=jQuery.trim(jQuery('#title').val());
var data = {
		'action': 'my_action',
		'whatever': ajax_object.we_value,      // We pass php values differently!
		'titulo' :tituloTemp     // We pass php values differently!
	};

if (ajax_object.we_value==1) {
	//alert('vale: 1 ');
	console.log(ajax_object.we_value);
};

		if(($title_value == 0 && $title_value != " ")|| ajax_object.we_value==1){
			//alert('Please insert title');
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

});*/