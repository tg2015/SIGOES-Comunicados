<?php
//Eliminar Edicion de la Categoria en Quick Edit y eliminar agregar mas categorias
function customAdminCSS() {
    echo '<style type="text/css">
    .inline-edit-col .inline-edit-categories-label, .inline-edit-col .category-checklist {
    	display: none !important;
    }
    </style>';
//Elimar opcion Agregar mas cetegorias
echo '<style type="text/css">#category-add-toggle {
    display: none;
    visibility: hidden;
}
    </style>';

   ///Ocultar div de Categorias.  
    echo '<style type="text/css">
    #categorydiv {
    display: none;
    visibility: hidden;
}
    </style>';
    // Desactivar Actualizacion de AAM
 echo '<style type="text/css">
    #advanced-access-manager-update {
    display: none;
    visibility: hidden;
}
    </style>';

  //Desactivar Actualizacion de Bitacora
 echo '<style type="text/css">
    #stream-update {
    display: none;
    visibility: hidden;
}
    </style>';

      ///Ocultar div de Autor.  
    echo '<style type="text/css">
    #authordiv {
    display: none;
    visibility: hidden;
}
    </style>';
//Ocultar check categoria
echo '<style type="text/css">
    #categorydiv-hide {
    display: none;
    visibility: hidden;
}
    </style>';
 //Ocultar opcion quitar imagen 
echo '<style type="text/css">
    #remove-post-thumbnail {
    display: none;
    visibility: hidden;
}
    </style>';


//requiridos
/* style all input elements with a required attribute */
echo '<style type="text/css">
/*input:required {
  box-shadow: 4px 4px 20px rgba(200, 0, 0, 0.85);
}*/

.requerido:after {
content:" *"; 
color: #e32;
margin: 0px 0px 0px 2px; 
font-size: large; 
padding: 0 5px 0 0; }

input:required:after {
content:"*"; 
color: #e32;
position: absolute; 
margin: 0px 0px 0px 5px; 
font-size: large; 
padding: 0 5px 0 0; }

/**
 * style input elements that have a required
 * attribute and a focus state
 */
input:required:focus {
  border: 1px solid red;
  outline: none;
}

/**
 * style input elements that have a required
 * attribute and a hover state
 */
input:required:hover {
  opacity: 1;
}
 </style>';
//
}//Fin customAdminCSS
add_action('admin_head', 'customAdminCSS');

/*------------------------------------------------------------------------------------
    Remover edicion rapida los comunicados
------------------------------------------------------------------------------------*/
add_filter( 'post_row_actions', 'remove_row_actions', 10, 2 );//10-> prioridad, 2-> Parametros de funcion
function remove_row_actions( $actions, $post )
{
  global $current_screen;
   //if( $current_screen->post_type != 'proyecto'&& $current_screen->post_type != 'evento' && $current_screen->post_type != 'streaming'  ) return $actions;
    //unset( $actions['edit'] );
    //unset( $actions['view'] );
    //unset( $actions['trash'] );
    unset( $actions['inline hide-if-no-js'] );//Edicion Rapida
    //$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );

    return $actions;
}


/*------------------------------------------------------------------------------------
    Agregar nuevas categorias
------------------------------------------------------------------------------------*/
//Definir las categorias de Los Comunicados
function categoria(){
$my_catProyecto = array('cat_name' => 'proyectos', 
    'category_description' => 'Proyectos sociales de CAPRES',
     'category_nicename' => 'proyectos',
      'category_parent' => '');

// Create the category
wp_insert_category($my_catProyecto);

$my_catEventos = array('cat_name' => 'eventos', 
    'category_description' => 'Eventos de emergencias que ocurren en El Salvador',
     'category_nicename' => 'eventos',
      'category_parent' => '');
// Create the category
wp_insert_category($my_catEventos);

$my_catStreaming = array('cat_name' => 'streaming', 
    'category_description' => 'Transmisión de vídeo en vivo de Streaming',
     'category_nicename' => 'streaming',
      'category_parent' => '');
// Create the category
wp_insert_category($my_catStreaming);

$my_catOtros = array('cat_name' => 'otros', 
    'category_description' => 'Otro tipos de comunicados de CAPRES',
     'category_nicename' => 'otros',
      'category_parent' => '');

// Create the category
wp_insert_category($my_catOtros);


}
add_action('admin_init','categoria');
/*------------------------------------------------------------------------------------
    Fin Agregar nuevos categorias
------------------------------------------------------------------------------------*/
?>