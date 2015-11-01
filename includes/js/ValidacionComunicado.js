jQuery(document).ready(function() {

	jQuery("#title").attr("required", "true");//Titulo requrido
	//Deshabilitar envio submit por Enter (13)
	jQuery('form input').on('keypress', function(e) {
    return e.which !== 13;
});
	jQuery( document ).on( 'click', '#publish', function() {
	//var post_id = jQuery(this).data('id')
	//jQuery("#submitdiv").trigger('click');
	var title_value = jQuery.trim(jQuery('#title').val());
	alert("Titulo "+title_value);
	var form_data2 = jQuery('#post').serializeArray();//Todo el post
	var flag = null;
	jQuery.ajax({
		url : ajax_object.ajax_url,
		type : 'post',
		data : {
			action : 'my_action',
			titulo : title_value,
			form_data: jQuery.param(form_data2)
		},
		async:false,
		success : function( response ) {
				//alert("esto es el respose :"+response);
				if (response=='@valido@') {
					alert("response "+response);
					flag = true;
				}else if(response=='@invalido@'){
						alert("response "+response);
						jQuery('.spinner').css("visibility", "hidden");
						jQuery('#title').focus();
						flag = false;}
					else{
						var n = response.search("@invalido@");
						alert("valor n: "+n);
						if (n!=-1) {
							alert("response "+response);
							jQuery('.spinner').css("visibility", "hidden");
							jQuery('#title').focus();
							flag = false;
							}
						else{flag=true;}	
						}
				
		}
	});
	alert("Esto es flag: "+flag);
	return flag;
})
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

});
//jQuery( "#publish" ).removeClass( "button-primary" ).addClass('button');
	//jQuery("#submitdiv").click(function(){alert("Click")});*/