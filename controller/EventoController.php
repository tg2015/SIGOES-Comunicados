<?php

//Clase para Crear Eventos de CAPRES.
class EventoController
{

private $post_ID;
	public function __construct()
	{
		//Setear Categoria por defecto para Eventos
		/**
		 * @param  [int] $post_ID. Identificador de CPT evento.	
		 * @return [type] Ninguno
		 */
		function default_category_evento($post_ID)
		{	// el parametro '3' Corresponde term_id de eventos  que esta en la tabla wp_terms
        	wp_set_post_categories($post_ID, 3 );  
        }
        	//Hook Para Establecer Categoria por Defecto cada vez que entre al menu de Eventos
        	add_action( 'save_post', 'default_category_evento' );
       	/**..**/
	}

///Funcion para crear los Custom Type Post para Eventos.

/**
 * Registrat post type Eventos.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

public function EventoInit()
	{ 

		function EventoCTP()
		 {
			$labels = array(
			'name'               => _x( 'Eventos Coyunturales', 'post type nombre General', 'SIGOES-Comunicados' ),
			'singular_name'      => _x( 'Evento', 'post type nombre Singular', 'SIGOES-Comunicados' ),
			'menu_name'          => _x( 'Eventos Coyunturales', 'admin menu', 'SIGOES-Comunicados' ),
			'name_admin_bar'     => _x( 'Evento', 'add new on admin bar', 'SIGOES-Comunicados' ),
			'add_new'            => _x( 'Agregar Nuevo', 'evento', 'SIGOES-Comunicados' ),
			'add_new_item'       => __( 'Agregar Nuevo Evento', 'SIGOES-Comunicados' ),
			'new_item'           => __( 'Nuevo Evento', 'SIGOES-Comunicados' ),
			'edit_item'          => __( 'Editar Evento', 'SIGOES-Comunicados' ),
			'view_item'          => __( 'Ver Evento', 'SIGOES-Comunicados' ),
			'all_items'          => __( 'Todos los Eventos', 'SIGOES-Comunicados' ),
			'search_items'       => __( 'Buscar Eventos', 'SIGOES-Comunicados' ),
			'parent_item_colon'  => __( 'Parent Eventos:', 'SIGOES-Comunicados' ),
			'not_found'          => __( 'No se encontraron Eventos.', 'SIGOES-Comunicados' ),
			'not_found_in_trash' => __( 'No se encontraron Eventos en Papelera.', 'SIGOES-Comunicados' )
			
							);

			$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Descripcion.', 'SIGOES-Comunicados' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'evento' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', /**'thumbnail', **/'category' ),//Los eventos no Tienen Imagen Destacada
			'taxonomies' => array( 'category'),
			'menu_icon' => 'dashicons-megaphone'
						);
			///Registrar Nuestro CTP (Custom Type Post)
				register_post_type( 'evento', $args ); 

		}/// fin Funcion EventoCTP

		//Hook init para agregar CPT al menu de Administracion.
		add_action( 'init', 'EventoCTP' );
		//Remover La opcion de Modificar Categorias 	
			function RemoverCategoriaEvento() 
			{
  			 remove_meta_box('categorydiv', 'evento', 'side');
  			}
			add_action( 'admin_menu', 'RemoverCategoriaEvento' );

	}////fin Funcion EventoInit


}//fin class EventoController.
//Instaciar la clase para que los Evento se Desplieguen en la Admin Bar
$varMenu= new EventoController();
$varMenu->EventoInit();
?>
