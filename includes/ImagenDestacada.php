<?php
// Requerir imagen destacada
function ValidarImagen(){
add_action('save_post', 'wpds_check_thumbnail');
add_action('publish_post','wpds_check_thumbnail');
add_action('admin_notices', 'wpds_thumbnail_error');
function wpds_check_thumbnail($post_id) {
    // cambia esto para cualquier tipo de entrada personalizada
    if(get_post_type($post_id) != 'proyecto')
        return;
    if ( !has_post_thumbnail( $post_id ) && 'trash' != get_post_status( $post_id )) {
        // se muestra un mensaje a los usuarios
        set_transient( "has_post_thumbnail", "no" );
        // desengancha la funcion para evitar un look infinito
        remove_action('save_post', 'wpds_check_thumbnail');
        // actualiza la entrada y la pone como borrador
        wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
        add_action('save_post', 'wpds_check_thumbnail');
    } else {
        delete_transient( "has_post_thumbnail" );
    }
}
function wpds_thumbnail_error($post_id)
{
    // comprueba si falta la imagen y muestra el mensaje de error
    $titulo=get_the_title( $post_id );
    if ( get_transient( "has_post_thumbnail" ) == "no" ) {
        echo "<div id='msjDestacada1' class='error'><p><strong>Debes establecer una Imagen Destacada al Proyecto: ".$titulo.".</strong></p>
                <p>NOTA: El borrador automatico esta habilitado, pero no puedes publicarla aún.</p></div>";
        
        delete_transient( "has_post_thumbnail" );
    }
}

}//Fin ValidarImagen
?>