<?php

add_action( 'admin_enqueue_scripts','action_admin_enqueue_scripts'  );
function action_admin_enqueue_scripts() {
      
    // javascriptp para modificar post status dropdown donde aparezca.
      wp_enqueue_script( 'edit_flow-custom_status', plugins_url('SIGOES-Comunicados/includes/js/EstadoComunicado.js'), array( 'jquery','post' ), '', true );
    
  }

//Agregar estado de cancelado
function jc_custom_post_status(){
     register_post_status( 'cancelado', array(
          'label'                     => _x( 'cancelado', 'proyecto' ),
          'public'                    => false,//Para que NO aparezca en el Feed
          'show_in_admin_all_list'    => false,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Cancelado <span class="count">(%s)</span>', 'Cancelados <span class="count">(%s)</span>' ),
          'exclude_from_search'       => false
     ) );
}
add_action( 'init', 'jc_custom_post_status' );

function jc_display_cancelado_state( $states ) {
     global $post;
     //echo 'Estado es: '.$post->post_status;
     $arg = get_query_var( 'post_status' );
     if($arg != 'cancelado'){
          if($post->post_status == 'cancelado'){
               return array('cancelado');
          }
     }
    return $states;
}
add_filter( 'display_post_states', 'jc_display_cancelado_state' );





/* Css Para el estado Cancelado */
function jc_append_post_status_bulk_edit() {
    //Eliminar  Editar de la Lista de Acciones en lote 
    echo '
     <script>
     jQuery(document).ready(function($){
     $("#bulk-action-selector-top").find("option[value=edit]").remove();  
     });
     </script>
            ';
//Agregar al inline edit estado "cancelado" 
echo "<script>
  jQuery(document).ready( function() {
    jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"cancelado\">Cancelado</option>' );
  });
  </script>";
}

add_action( 'admin_footer-edit.php', 'jc_append_post_status_bulk_edit' );

/* Agregar estado cancelado en edit dropdown */

add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions' );
function my_post_submitbox_misc_actions(){

global $post;

//only when editing a post
if( $post->post_type == 'proyecto' ||$post->post_type == 'evento' ||$post->post_type == 'streaming'||$post->post_type == 'otros'  ){
    // custom post status: approved
    $complete = '';
    $label = '';   

    if( $post->post_status == 'cancelado' ){
        $complete = ' selected=\"selected\"';
        $label = '<span id=\"post-status-display\"> cancelado</span>';
    }
    //echo "Boton Publicar Deshabilitado sino hay imagen destacada";
    echo '<script>
    jQuery(document).ready(function($){
        $("select#post_status").append("<option value=\"cancelado\" '.$complete.'>Cancelado</option>");
        $(".misc-pub-section label").append("'.$label.'");
    });
    </script>';

   }//Fin If ( $post->post_type == 'proyecto' )

global $pagenow;
    //echo $pagenow;
if ( in_array( $pagenow, array( 'post-new.php' ) ) )
    {
      //echo ">Entro post-new  ";
     echo '
     <script>
     jQuery(document).ready(function($){
     $("#post_status").find("option[value=cancelado]").remove();  
     });
     </script>
            ';
    }
   
}// Fin my_post_submitbox_misc_actions



?>
