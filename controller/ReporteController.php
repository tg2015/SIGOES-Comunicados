<?php
/*---------------------------------------------------*/
/* Agregar Grupo de opciones al perfil de usuario
/*---------------------------------------------------*/
add_action( 'show_user_profile', 'extended_user_profil_fields' );
add_action( 'edit_user_profile', 'extended_user_profil_fields' );
 
function extended_user_profil_fields( $user ) { ?>

<h3><?php _e("Institucion a la que pertenece el usuario", "blank"); ?></h3>
 
<table class="form-table">
   <tr>
      <th><label for="institucion"><?php _e("Institucion"); ?></label></th>
      <td>
         <input    type="text" name="institucion" id="institucion" 
               value="<?php echo esc_attr( get_the_author_meta( 'institucion', $user->ID ) ); ?>" 
               class="regular-text" /><br />
         <span class="description"><?php _e("Inrgrese institucion."); ?></span>
      </td>
   </tr>
   <tr>
</table>

<?php }
 
add_action( 'personal_options_update', 'save_extended_user_profil_fields' );
add_action( 'edit_user_profile_update', 'save_extended_user_profil_fields' );

//Función que guarda los cambios 
function save_extended_user_profil_fields( $user_id ) {
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
 
update_usermeta( $user_id, 'institucion', $_POST['institucion'] );
//update_usermeta( $user_id, 'ciudad', $_POST['ciudad'] );
}

function Activar_Reporte_Sigoes()
{
    add_menu_page('Reporte SIGOES', 'Reporte SIGOES', 'manage_options', 'Reporte_SIGOES', 'MostrarReporte', 'dashicons-welcome-write-blog', 51);
    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page('null', 'ReporteComunicados', 'ReporteComunicados', 'manage_options', 'ReporteComunicados', 'ReporteComunicados', 'ReporteComunicados');
}
add_action('admin_menu', 'Activar_Reporte_Sigoes');


add_action( 'in_admin_footer', 'registrar_CamposRequeridos' );
function registrar_CamposRequeridos()
{
  ?>
    <script>
      (function ($) {
        $('#first_name').prop('required',true);
        $('#last_name').prop('required',true);
      }(jQuery));
    </script>

    <script>
      jQuery(document).ready(function() {
        jQuery( document ).on( 'click', '#createusersub', function(){
          var nombre = jQuery.trim(jQuery('#first_name').val());
          var apellido = jQuery.trim(jQuery('#last_name').val());
        if (nombre == null || nombre.trim() == ""){
          alert("Debe llenar el campo nombre");
          document.getElementById('first_name').focus()
          return false;
          }
        if (apellido == null || apellido.trim() == ""){
          alert("Debe llenar el campo apellido");
          document.getElementById('last_name').focus()
          return false;
          }  
      });

      jQuery( document ).on( 'click', '#submit', function(){
          var nombre = jQuery.trim(jQuery('#first_name').val());
          var apellido = jQuery.trim(jQuery('#last_name').val());
        if (nombre == null || nombre.trim() == ""){
          alert("Debe llenar el campo nombre");
          document.getElementById('first_name').focus()
          return false;
          }
        if (apellido == null || apellido.trim() == ""){
          alert("Debe llenar el campo apellido");
          document.getElementById('last_name').focus()
          return false;
          }  
      });

    }); 
    </script>
  <?php
}


function ReporteComunicados()
{
  require_once(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporteComunicados.php');
}


// Muestra reporte en pantalla
function MostrarReporte()
{
    echo '<div class="wrap"><h1>'. __('Reporte SIGOES') .'</h1>';
    require_once(SIGOES_PLUGIN_DIR.'view/ReporteView.php');
    $vista = new ReporteView;
    echo '</div>';
}

add_action( 'admin_enqueue_scripts', 'rgistro_de_archivos_js' );

function rgistro_de_archivos_js( ) {

if( !is_admin()){
   wp_deregister_script('jquery');    
  wp_register_script( 'jquery', plugins_url('SIGOES-Comunicados/includes/js/Calendario/jquery-1.9.1.js'), false,'1.9.1',true );
  wp_enqueue_script( 'jquery' );
}


wp_register_script( 'jquery-ui-js', plugins_url('SIGOES-Comunicados/includes/js/Calendario/jquery-ui.js'), array( 'jquery' ) );
wp_enqueue_script( 'jquery-ui-js' );

}        
add_action( 'admin_enqueue_scripts', 'register_plugin_styles' );
function register_plugin_styles() {
    wp_register_style( 'jquery-ui-css', plugins_url( 'SIGOES-Comunicados/includes/js/Calendario/jquery-ui.css' ) );
  wp_enqueue_style( 'jquery-ui-css' );
}


add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}


class ReporteController
{

///////////   CONSULTAS PARA OBTENER ITEMS DEL SELECT
public function get_sql_post_status()
{
    require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
    $model_consulta = new ReporteModel();
    // Consultas para llenar las opciones del select
    $estados_array = $model_consulta->get_post_status(); 
    return ($estados_array);
}

public function get_sql_post_type()
{
    require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
    $model_consulta = new ReporteModel();
    $categorias_array = $model_consulta->get_post_type(); 
    $rol_array =  $model_consulta->get_rol_user(); 
    return ($categorias_array);
}

public function get_sql_rol_user()
{

    require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
    $model_consulta = new ReporteModel();
    $rol_array =  $model_consulta->get_rol_user(); 
    return ($rol_array);
}

public function get_sql_nickname_user()
{
    require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
    $model_consulta = new ReporteModel();
    $nick_array =  $model_consulta->get_nickname_user(); 

    return $nick_array;
}
////////////////// CONSULTAS PARA OBTENER REPORTE PANTALLA - ARCHIVO CSV
public function get_sql_result_pantalla($estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin, $filtro_titulo)
{
    require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
    $model_consulta = new ReporteModel();
    $sql_result =  $model_consulta->get_reporte($estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin, $filtro_titulo); 

    return ($sql_result);
}

public function get_sql_result_csv($estado,$cat,$autor,$nick,$fecha_ini,$fecha_fin)
{

    require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
    $model_consulta = new ReporteModel();
    $array_results =  $model_consulta->get_reporte_csv($estado, $cat, $autor, $nick,$fecha_ini,$fecha_fin);

    return $array_results;
}


/////////////////////////////////////////////////////
    /*public function crear_archivo_csv($output,$array_results)
    {
    header("Content-type: application/csv charset=utf-8");
    header("Content-Disposition: attachment; filename=Fichero-". time() .".csv");
    header('Content-Length: '. strlen($output) );
    echo $output;
    }

    public function Listar($estado, $cat, $autor,$nick,$fecha_ini,$fecha_fin)
    {
            
            require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $consulta = new ReporteModel();
            $sql_result =  $consulta->get_reporte($estado, $cat, $autor,$nick,$fecha_ini,$fecha_fin); 
    }*/

}
?>