<?php
//Clase para Crear Otros Proyectos de CAPRES.
class OtrosController
{


	public function __construct()
	{
function default_category_save4($post_ID)
		{
			$_idCPT=0;//id CPT
			$_tipoCPT="";// variable tipo CPT
			$_idCPT=$post_ID; //Asignar id CPT
			$_tipoCPT=get_post_type( $post_ID );//Obtener tipo CPT.
			if ($_tipoCPT=="otros") {
				//Obtener Dinamicamente id Categoria otros 
				require_once(SIGOES_PLUGIN_DIR.'/model/ComunicadoModel.php');//Modelo Para comunicados
  				$model = new  ComunicadoModel(); //Instanciar La clase ComunicadoModel
  				$resultado = $model->get_Categoria("otros");//Obtener el Id de la categoria "otros"
				wp_set_post_categories($post_ID, $resultado);//Asignar Categoria Automaticamente a otros nuevo


		}
        

    }
        add_action( 'save_post', 'default_category_save4' );

	/**..**/}

///Funcion para crear los Custom Type Post para  Otros Proyectos.

/**
 * Registrat post type  Otros Proyectos.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

public function OtrosInit()
	{ 

		function OtrosCTP()
		 {
			$labels = array(
			'name'               => _x( 'Otros Proyectos', 'post type nombre General', 'SIGOES-Comunicados' ),
			'singular_name'      => _x( 'Otro Proyecto', 'post type nombre Singular', 'SIGOES-Comunicados' ),
			'menu_name'          => _x( 'Otros Proyectos', 'admin menu', 'SIGOES-Comunicados' ),
			'name_admin_bar'     => _x( 'Otro Proyecto', 'add new on admin bar', 'SIGOES-Comunicados' ),
			'add_new'            => _x( 'Agregar Nuevo', 'evento', 'SIGOES-Comunicados' ),
			'add_new_item'       => __( 'Agregar Nuevo', 'SIGOES-Comunicados' ),
			'new_item'           => __( 'Nuevo Otro Proyecto', 'SIGOES-Comunicados' ),
			'edit_item'          => __( 'Editar Otro Proyecto', 'SIGOES-Comunicados' ),
			'view_item'          => __( 'Ver Otro Proyecto', 'SIGOES-Comunicados' ),
			'all_items'          => __( 'Todos los Otros Proyectos', 'SIGOES-Comunicados' ),
			'search_items'       => __( 'Buscar Otros Proyectos', 'SIGOES-Comunicados' ),
			'parent_item_colon'  => __( 'Parent Otro Proyecto:', 'SIGOES-Comunicados' ),
			'not_found'          => __( 'No se encontraron Otro Proyectos.', 'SIGOES-Comunicados' ),
			'not_found_in_trash' => __( 'No se encontraron Otros Proyectos en Papelera.', 'SIGOES-Comunicados' )
			
							);

			$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Descripcion.', 'SIGOES-Comunicados' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'otros' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail','category' ),
			'taxonomies' => array( 'category'),
			'menu_icon' => 'dashicons-format-image'
						);
			///Registrar Nuestro CTP (Custom Type Post)
				register_post_type( 'otros', $args ); 
		}/// fin Funcion OtrosCTP

		//Hook init para agregar CPT al menu de Administracion.
		add_action( 'init', 'OtrosCTP' );
	}////fin Funcion OtrosInit


}//fin class OtrosController.
//Instaciar la clase para que los  Otros Proyectos se Desplieguen en la Admin Bar
$varMenu1= new OtrosController();
$varMenu1->OtrosInit();
?>