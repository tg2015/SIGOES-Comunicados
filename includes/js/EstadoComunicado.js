
jQuery(document).ready(function() {


if ( jQuery('select[name="post_status"]').length > 0 ) {
    
    // Asignar al boton de guardar el value del elemento de la lista seleccionado
   var msjInit=jQuery('select[name="post_status"] :selected').text();
    ef_update_save_button('Guardar '+msjInit);
    
    // Bind event cuando el boton  aceptar es clickado.
    jQuery('.save-post-status').bind('click', function() {  
      ef_update_save_button();
    });
  }
///Asignar value a Boton save-post
function ef_update_save_button( text ) {
		if(!text) text = 'Guardar como ' + jQuery('select[name="post_status"] :selected').text();
		jQuery(':input#save-post').attr('value', text);
	}
///

});