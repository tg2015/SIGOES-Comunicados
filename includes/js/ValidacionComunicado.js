jQuery(document).ready(function() {
	//jQuery("#title").attr("required", "true");//Titulo requrido
	//Deshabilitar envio submit presionando la tecla Enter (13)
	jQuery('form input').on('keypress', function(e) {
    	return e.which !== 13;});
	//Validacion cuando se publica el comunicado
	jQuery( document ).on( 'click','#publish', function() {
		var title_value = jQuery.trim(jQuery('#title').val());
		//var form_data2 = jQuery('#post').serializeArray();//Todo el post
		var flag = null;
		jQuery.ajax({
			url : ajax_object.ajax_url,//Esta url es la que se configura en  
										//wp_localize_script de validacionComunicado 
			type : 'post',
			data : {
				action : 'my_action',//funcion que se llama en el hook de add_action( 'wp_ajax_my_action', 'my_action_callback' );
				titulo : title_value
				//form_data: jQuery.param(form_data2)
			},
			async:false,//Volver Sincrono ajax
			cache:false,//Acelerar Ajax
			success : function( response ) {
					//alert("esto es el respose :"+response);
					if (response=='@valido@') {
						//alert("response "+response);
						//alert("Titulo no permitido");
						flag = true;//para que click deje publicar
					}else if(response=='@invalido@'){
							//alert("response "+response);
							alert("Titulo no permitido");
							jQuery('.spinner').css("visibility", "hidden");
							jQuery('#title').focus();
							flag = false;}
						else{
							var n = response.search("@invalido@");
							//alert("valor n: "+n);
							if (n!=-1) {
								//alert("response "+response);
								alert("Titulo no permitido");
								jQuery('.spinner').css("visibility", "hidden");
								jQuery('#title').focus();
								flag = false;
								}
							else{flag=true;}	
							}
					
			}
		});
		//alert("Esto es flag: "+flag);
		return flag;//para que click deje publicar o no
	})//Fin 	jQuery( document ).on( 'click','#publish', function() {

	//Validacion cuando se guarda como borrador el comunicado	
	jQuery( document ).on( 'click','#save-post', function() {
		var title_value = jQuery.trim(jQuery('#title').val());
		//var form_data2 = jQuery('#post').serializeArray();//Todo el post
		var flag = null;
		jQuery.ajax({
			url : ajax_object.ajax_url,
			type : 'post',
			data : {
				action : 'my_action',
				titulo : title_value
				//form_data: jQuery.param(form_data2)
			},
			async:false,
			cache:false,
			success : function( response ) {
					//alert("esto es el respose :"+response);
					if (response=='@valido@') {
						//alert("response "+response);
						//alert("Titulo no permitido");
						flag = true;
					}else if(response=='@invalido@'){
							//alert("response "+response);
							alert("Titulo no permitido");
							jQuery('.spinner').css("visibility", "hidden");
							jQuery('#title').focus();
							flag = false;}
						else{
							var n = response.search("@invalido@");
							//alert("valor n: "+n);
							if (n!=-1) {
								//alert("response "+response);
								alert("Titulo no permitido");
								jQuery('.spinner').css("visibility", "hidden");
								jQuery('#title').focus();
								flag = false;
								}
							else{flag=true;}	
							}
					
			}
		});
		//alert("Esto es flag: "+flag);
		return flag;
	})//Fin 	jQuery( document ).on( 'click','#publish', function() {
});// Fin jQuery(document).ready(function() {
