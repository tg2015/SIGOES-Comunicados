<?php

//Clase para Crear Proyectos de CAPRES.
class ProyectoController
{

private $post_ID;
	public function __construct()
	{
		//Setear Categoria por defecto para Proyectos
		/**
		 * @param  [int] $post_ID. Identificador de CPT proyecto.	
		 * @return [type] Ninguno
		 */
		function default_category_proyecto($post_ID)
		{	// el parametro '2' Corresponde term_id de proyectos  que esta en la tabla wp_terms
        	wp_set_post_categories($post_ID, 2 );  
        }
        	//Hook Para Establecer Categoria por Defecto cada vez que entre al menu de Proyectos
        	add_action( 'save_post', 'default_category_proyecto' );
       	/**..**/
	}

///Funcion para crear los Custom Type Post para Proyectos.

/**
 * Registrat post type Proyectos.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

public function ProyectoInit()
	{ 

		function ProyectoCTP()
		 {
			$labels = array(
			'name'               => _x( 'Proyectos', 'post type nombre General', 'SIGOES-Comunicados' ),
			'singular_name'      => _x( 'Proyecto', 'post type nombre Singular', 'SIGOES-Comunicados' ),
			'menu_name'          => _x( 'Proyectos', 'admin menu', 'SIGOES-Comunicados' ),
			'name_admin_bar'     => _x( 'Proyecto', 'add new on admin bar', 'SIGOES-Comunicados' ),
			'add_new'            => _x( 'Agregar Nuevo', 'proyecto', 'SIGOES-Comunicados' ),
			'add_new_item'       => __( 'Agregar Nuevo Proyecto', 'SIGOES-Comunicados' ),
			'new_item'           => __( 'Nuevo Proyecto', 'SIGOES-Comunicados' ),
			'edit_item'          => __( 'Editar Proyecto', 'SIGOES-Comunicados' ),
			'view_item'          => __( 'Ver Proyecto', 'SIGOES-Comunicados' ),
			'all_items'          => __( 'Todos los Proyectos', 'SIGOES-Comunicados' ),
			'search_items'       => __( 'Buscar Proyectos', 'SIGOES-Comunicados' ),
			'parent_item_colon'  => __( 'Parent Proyectos:', 'SIGOES-Comunicados' ),
			'not_found'          => __( 'No se encontraron Proyectos.', 'SIGOES-Comunicados' ),
			'not_found_in_trash' => __( 'No se encontraron Proyectos en Papelera.', 'SIGOES-Comunicados' )
			
							);

			$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Descripcion.', 'SIGOES-Comunicados' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'proyecto' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'category' ),
			'taxonomies' => array( 'category'),
			'menu_icon' => 'dashicons-groups'
						);
			///Registrar Nuestro CTP (Custom Type Post)
				register_post_type( 'proyecto', $args ); 
		}/// fin Funcion ProyectoCTP



//********************Configuraciones extras*******************************************//
		//Hook init para agregar CPT al menu de Administracion.
		add_action( 'init', 'ProyectoCTP' );
		//Quitar botón agregar multimedia del editor
			function RemoverAddMediaButtons()
				{//if ( !current_user_can( 'level_10' ) ) {//DE SER NECESARIO VALIDAR USUARIO.
        		 remove_action( 'media_buttons', 'media_buttons' ); //}
        		}
		//hook para Remover boton de objeto
		add_action('admin_head', 'RemoverAddMediaButtons');
		
		//Remover Menu de Entradas por Defecto de WP
		function RemoverMenuEntradasWP() 
				{
				 remove_menu_page('upload.php');//Remover Menu Medios.
				 remove_menu_page('edit-comments.php');//Remover Menu Comentarios.
    	    	 remove_menu_page('edit.php'); //Remover Menu Entradas.
    	    	}
		add_action( 'admin_menu', 'RemoverMenuEntradasWP' ); 
		//Agregar los CPT a Main Feed
		function AgregarCPTMainFeed($qv) 
				{
				 if (isset($qv['feed']) && !isset($qv['post_type']))
				 $qv['post_type'] = array('proyecto', 'evento','streaming');
				 return $qv;
				}
		add_filter('request', 'AgregarCPTMainFeed');

		// Obligar Seleccionar Imgagen destacada*/
		
		//require_once(SIGOES_PLUGIN_DIR.'/includes/ImagenDestacada.php');
		//ValidarImagen();//Funcion que se encuentra en el archivo requirido.
		//Categoria por Proyecto

		//Remover La opcion de Modificar Categorias 	
			function RemoverCategoriaProyeto() 
			{
  			 remove_meta_box('categorydiv', 'proyecto', 'side');
  			}
			add_action( 'admin_menu', 'RemoverCategoriaProyeto' );
	}////fin Funcion ProyectoInit
/********************Fin Configuraciones extras*******************************************
function SetCategoria(){
function default_category_save($post_ID) {
  
  
        wp_set_post_categories( $post_ID, 3 );  
   

}
add_action( 'save_post', 'default_category_save' );
}**/

}//fin class ComunicadoController.
//Instaciar la clase para que los Proyectos se Desplieguen en la Admin Bar
$varMenu= new ProyectoController();
$varMenu->ProyectoInit();
//$varMenu->SetCategoria();
?>
