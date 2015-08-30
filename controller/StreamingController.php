<?php

//Clase para Crear Streaming de CAPRES.
class StreamingController
{


	public function __construct()
	{
		//Setear Categoria por defecto para Streaming
		/**
		 * @param  [int] $post_ID. Identificador de CPT streaming.	
		 * @return [type] Ninguno
		 */
		function default_category_streaming($post_ID)
		{	// el parametro '4' Corresponde term_id de eventos  que esta en la tabla wp_terms
        	wp_set_post_categories($post_ID, 4 );  
        }
        	//Hook Para Establecer Categoria por Defecto cada vez que entre al menu de Streaming
        	add_action( 'save_post', 'default_category_streaming' );
       	/**..**/
	}

///Funcion para crear los Custom Type Post para Streaming.

/**
 * Registrat post type Streaming.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

public function StreamingInit()
	{ 

		function StreamingCTP()
		 {
			$labels = array(
			'name'               => _x( 'Streaming', 'post type nombre General', 'SIGOES-Comunicados' ),
			'singular_name'      => _x( 'Streaming', 'post type nombre Singular', 'SIGOES-Comunicados' ),
			'menu_name'          => _x( 'Streaming', 'admin menu', 'SIGOES-Comunicados' ),
			'name_admin_bar'     => _x( 'Streaming', 'add new on admin bar', 'SIGOES-Comunicados' ),
			'add_new'            => _x( 'Agregar Streaming', 'streaming', 'SIGOES-Comunicados' ),
			'add_new_item'       => __( 'Agregar Nuevo Streaming', 'SIGOES-Comunicados' ),
			'new_item'           => __( 'Nuevo Streaming', 'SIGOES-Comunicados' ),
			'edit_item'          => __( 'Editar Streaming', 'SIGOES-Comunicados' ),
			'view_item'          => __( 'Ver Streaming', 'SIGOES-Comunicados' ),
			'all_items'          => __( 'Todos los Streaming', 'SIGOES-Comunicados' ),
			'search_items'       => __( 'Buscar Streaming', 'SIGOES-Comunicados' ),
			'parent_item_colon'  => __( 'Parent Streaming:', 'SIGOES-Comunicados' ),
			'not_found'          => __( 'No se encontraron Streaming.', 'SIGOES-Comunicados' ),
			'not_found_in_trash' => __( 'No se encontraron Streaming en Papelera.', 'SIGOES-Comunicados' )
			
							);

			$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Descripcion.', 'SIGOES-Comunicados' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'streaming' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', /**'thumbnail', **/'category' ),//El Streaming no Tiene Imagen Destacada
			'taxonomies' => array( 'category'),
			'menu_icon' => 'dashicons-video-alt2'
						);
			///Registrar Nuestro CTP (Custom Type Post)
				register_post_type( 'streaming', $args ); 
		}/// fin Funcion StreamingCTP

		//Hook init para agregar CPT al menu de Administracion.
		add_action( 'init', 'StreamingCTP' );
		//Remover La opcion de Modificar Categorias 
			function RemoverCategoriaStreaming() 
			{
  			 remove_meta_box('categorydiv', 'streaming', 'side');
  			}
			add_action( 'admin_menu', 'RemoverCategoriaStreaming' );

	}////fin Funcion StreamingInit


}//fin class StreamingController.
//Instaciar la clase para que los Streaming se Desplieguen en la Admin Bar
$varMenu= new StreamingController();
$varMenu->StreamingInit();
?>
