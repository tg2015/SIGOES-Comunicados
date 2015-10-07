jQuery(document).ready(function($) {
  jQuery('#publish').click(function(){
	//Obtener el Titulo del Comunicado que se esta digitando
	$title_value = jQuery.trim(jQuery('#title').val());
	//Obtener el Titulo del Comunicado que se esta digitando para concatenar con AJAX
	var tituloTemp=jQuery.trim(jQuery('#title').val());
	//Objeto AJAX para acceder desde PHP
	var data = {
			'action': 'my_action',
			'whatever': ajax_object.we_value,      // we_value Recibe el valor seteado en php!
			'titulo' :ajax_object.titulo+tituloTemp /* titulo Recibe el Valor seteado en php!
														tituloTemp contiene el titulo del comunicado actual*/
		};
	//Validar que el Titulo no este vacio, con Cero, o con Una palabra no permitida
	//(Palabra no permitida se controla con "ajax_object.we_value" )	
	if(($title_value == 0 && $title_value != " ")|| ajax_object.we_value==1){
		alert('Titulo no Valido');
		jQuery('.spinner').css("visibility", "hidden");
		jQuery('#title').focus();
		return false;
		}
	}); // Fin jQuery('#publish').click(function()
	// draft button validation
	jQuery('#save-post').click(function(){
		$title_value = jQuery.trim(jQuery('#title').val());
		if($title_value == 0 && $title_value != " "){
			alert('Please insert title');
			jQuery('.spinner').css("visibility", "hidden");
			jQuery('#title').focus();
			return false;
		}
	});// Fin jQuery('#save-post').click(function()
});// Fin jQuery(document).ready(function($)