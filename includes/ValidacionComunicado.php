<?php
class ValidacionComunicado
{
	private $valorCoreccion;
	function __construct()
	{
		# code...
		add_action( 'admin_enqueue_scripts', array( $this, 'my_enqueue' ) );
		

		add_action( 'wp_ajax_my_action', array( $this, 'my_action_callback' ));

	}//Fin Construct
function my_enqueue($hook) {
    if( /*'index.php' != $hook ||*/'post-new.php' != $hook /*||'post.php' != $hook || 'edit.php' != $hook */) {
	// Only applies to dashboard panel
	return;
    }
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/ValidacionComunicado.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
          array( 'ajax_url' => admin_url( 'admin-ajax.php' )/*,'titulo'=>' ','we_value' => 0*/) );
}//fin my_enqueue

function my_action_callback() {
	global $wpdb;
	global $tituloGLOBAL;
    $titulo = $_POST['titulo'];
    $titulo2=$titulo;
    $tituloGLOBAL=$titulo;
	//$titulo += ' PHP';
        echo $titulo;    

$whatever = intval( $_POST['whatever'] );
	$whatever += 100;
        echo $whatever;

/////Prueba setear JS

///
///
///
	wp_die();
}// Fin my_action_callback

public function set_we_value(){
	function setearJS(){
		global $hola;
		wp_enqueue_script( 'ajax-script', plugins_url( '/js/ValidacionComunicado.js', __FILE__ ), array('jquery') );
	wp_localize_script( 'ajax-script', 'ajax_object',
          array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'we_value' => $hola) );
	}
	add_action( 'admin_enqueue_scripts', 'setearJS' );
	
}
 public function get_ValidacionTitulo()
        {
        	global $tituloGLOBAL;
        	$valorCoreccion=0;
//            require_once(SIGOES_PLUGIN_DIR.'/includes/ValidacionInternaComunicado.php');
  //           $Correcciones = deshoyganizar_comentarios_viejos($tituloGLOBAL);
    //         if (strcmp($tituloGLOBAL, $Correcciones) !== 0) {
   				 //echo '$var1 no es igual a $var2 en una comparación que considera mayúsculas y minúsculas';
   	//			 $valorCoreccion=1;
		
             return $valorCoreccion;

        }


}//Fin class ValidacionComunicado

$foo = new ValidacionComunicado;

$correcion=$foo->get_ValidacionTitulo();
if ($correcion!=0) {
	$hola=1;
	global $pagenow;
	if ( in_array( $pagenow, array( 'post-new.php' ) ) ){

add_action('admin_notices', 'wpds_thumbnail_error2');
function wpds_thumbnail_error2()
{
    // comprueba si falta la imagen y muestra el mensaje de error
              echo "<div id='msjValidacion1' class='error'><p><strong>* Contenido no valido:</strong></p>
                <p>NOTA: Revisar contenido de titulo o cuerpo del comunicado.</p></div>";
       
    
}
}// Fin page-now

	$foo->set_we_value();

}//Fin $correcion
else $hola=0;

//Regresar cuando funcionaba
//
/*add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue($hook) {
    if( /*'index.php' != $hook ||quite un '*'/'post-new.php' != $hook /*||'post.php' != $hook || 'edit.php' != $hook quite un'*'/) {
	// Only applies to dashboard panel
	return;
    }
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/ValidacionComunicado.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
          array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'titulo'=>'','we_value' => 0) );
}

// Same handler function...
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
	global $wpdb;
	
    $titulo = $_POST['titulo'];
    $titulo2=$titulo;
	//$titulo += ' PHP';
        echo $titulo;    

$whatever = intval( $_POST['whatever'] );
	$whatever += 100;
        echo $whatever;


	wp_die();
}*/

?>