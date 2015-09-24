<?php

//Clase para Crear Eventos de CAPRES.
class EventoController
{


	public function __construct()
	{
function default_category_save3($post_ID)
		{
			$_idCPT=0;//id CPT
			$_tipoCPT="";// variable tipo CPT
			$_idCPT=$post_ID; //Asignar id CPT
			$_tipoCPT=get_post_type( $post_ID );//Obtener tipo CPT.
			if ($_tipoCPT=="evento") {
				//Obtener Dinamicamente id Categoria Eventos 
				global $wpdb;
				$WP_term_id3 = $wpdb->get_row( "SELECT term_id FROM $wpdb->terms WHERE slug = 'eventos'", ARRAY_N );
				$ID_CategoriaEventos=(int)$WP_term_id3[0];
			 	wp_set_post_categories($post_ID, $ID_CategoriaEventos );
		}
        

    }
        add_action( 'save_post', 'default_category_save3' );

	/**..**/}

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
		}/// fin Funcion ProyectoCTP

		//Hook init para agregar CPT al menu de Administracion.
		add_action( 'init', 'EventoCTP' );
	}////fin Funcion ProyectoInit


}//fin class ComunicadoController.
//Instaciar la clase para que los Proyectos se Desplieguen en la Admin Bar
$varMenu1= new EventoController();
$varMenu1->EventoInit();
?>
