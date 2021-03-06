<?php
//Clase para Crear Proyectos de CAPRES.
class ProyectoController
{


	public function __construct()
	{
//$this->post_ID;
//
function default_category_save2($post_ID){
			$_idCPT=0;//id CPT
			$_tipoCPT="";// variable tipo CPT
			$_idCPT=$post_ID;//Asignar id CPT
			$_tipoCPT=get_post_type( $post_ID );//Obtener tipo CPT.
			if ($_tipoCPT=="proyecto") {
				//Obtener Dinamicamente id Categoria Proyectos 
				require_once(SIGOES_PLUGIN_DIR.'/model/ComunicadoModel.php');//Modelo Para comunicados
  				$model = new  ComunicadoModel(); //Instanciar La clase ComunicadoModel
  				$resultado = $model->get_Categoria("proyectos");//Obtener el Id de la categoria "proyectos"
				wp_set_post_categories($post_ID, $resultado);//Asignar Categoria Automaticamente a proyecto nuevo
			 }


		}
        add_action( 'save_post', 'default_category_save2' );

		

	/**..**/}

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
			'public'             => true,//Si el Post aparecera publico en el sitio
			'publicly_queryable' => true,//Si el Post aparece en la Busqueda del sitio
			'show_ui'            => true,
			'show_in_menu'       => true,//Si se muestra en el menu de administracion
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'proyecto' ),//ID del CPT
			'capability_type'    => 'post',//De donde deriba el CPT, Existen otros tipos como Admon de media etc
			'has_archive'        => true,// Si se puede agregar un archico el CPT
			'hierarchical'       => false,
			'menu_position'      => null,//Posicion del Menu en el Admin menu
			//las caracteristicas esenciales a la hora de agregar un nuevo Proyecto
										// titulo, editor, autor, imgen destacada	,categoria, campos personalizads
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'category'/*,'custom-fields'*/ ),
			'taxonomies' => array( 'category'),//Categoria del proyecto
			'menu_icon' => 'dashicons-groups'//Icono del CPT
						);
			///Registrar Nuestro CTP (Custom Type Post)
				register_post_type( 'proyecto', $args ); //ID dep CPT
		}/// fin Funcion ProyectoCTP

//********************Configuraciones extras*******************************************//
		//Hook init para agregar CPT al menu de Administracion.
		add_action( 'init', 'ProyectoCTP' );
		//Quitar botón agregar multimedia del editor
			function RemoverAddMediaButtons()
				{//
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
    	    	 remove_menu_page('edit-tags.php'); //Remover Menu categorias.
    	    	 //Remover Categorias dentro de proyectos, eventos, streaming
    	    	 remove_submenu_page( 'edit.php?post_type=evento', 'edit-tags.php?taxonomy=category&amp;post_type=evento' );
    	    	 remove_submenu_page( 'edit.php?post_type=proyecto', 'edit-tags.php?taxonomy=category&amp;post_type=proyecto' );
    	    	 remove_submenu_page( 'edit.php?post_type=streaming', 'edit-tags.php?taxonomy=category&amp;post_type=streaming' );
    	    	 remove_submenu_page( 'edit.php?post_type=otros', 'edit-tags.php?taxonomy=category&amp;post_type=otros' );

    	    	}
		add_action( 'admin_menu', 'RemoverMenuEntradasWP' ); 
		//Agregar los CPT a Main Feed
		function AgregarCPTMainFeed($qv) 
				{
				 if (isset($qv['feed']) && !isset($qv['post_type']))
				 $qv['post_type'] = array('proyecto', 'evento','streaming','otros');//CPT creados
				 return $qv;
				}
		add_filter('request', 'AgregarCPTMainFeed');

		// Obligar Seleccionar Imgagen destacada*/
		
		require_once(SIGOES_PLUGIN_DIR.'/includes/ImagenDestacada.php');
		ValidarImagen();//Funcion que se encuentra en el archivo requirido.
		
		//Agregar los CPT al menu categorias en la parte publica de wordpress
		add_filter('pre_get_posts', 'query_post_type');
			function query_post_type($query) {
			  if(is_category() || is_tag()) {
			    $post_type = get_query_var('post_type');
				if($post_type)
				    $post_type = $post_type;
				else
				    $post_type = array('post','proyecto','streaming','evento','otros'); // replace cpt to your custom post type
			    $query->set('post_type',$post_type);
				return $query;
			    }
			}
		//MVC para Ayuda de Wordpress con respecto a CPT wordpress
		require_once(SIGOES_PLUGIN_DIR.'/view/ComunicadoVista.php');
		$varAyudaProyecto= new ComunicadoVista();
		$varAyudaProyecto->RenderAyudaComunicado( );//Funcion que se encuentra en el archivo requirido.
		//Ordenar Visualmente los Comunicados
		require_once(SIGOES_PLUGIN_DIR.'/model/OrdenarComunicadoModel.php');
		$scporder = new OrdenarComunicadoModel();

//Google Analytics
add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69850406-1', 'auto');
  ga('send', 'pageview');

</script>
<?php
	}//fin add_googleanalytics
}////fin Funcion ProyectoInit
/********************Fin Configuraciones extras*******************************************/

}//fin class ComunicadoController.
//Instaciar la clase para que los Proyectos se Desplieguen en la Admin Bar
$varMenu= new ProyectoController();
$varMenu->ProyectoInit();
?>