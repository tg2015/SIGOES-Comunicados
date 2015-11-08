<?php
function Activar_Reporte_Sigoes()
{
    add_menu_page('Reporte SIGOES', 'Reporte SIGOES', 'manage_options', 'Reporte_SIGOES', 'MostrarReporte', 'dashicons-welcome-write-blog');
    //this submenu is HIDDEN, however, we need to add it anyways
    
    add_submenu_page('null', 'ReporteComunicados', 'ReporteComunicados', 'manage_options', 'ReporteComunicados', 'ReporteComunicados', 'ReporteComunicados');
}

function ReporteComunicados()
{
  require_once(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporteComunicados.php');
}


add_action('admin_menu', 'Activar_Reporte_Sigoes');

// Muestra reporte en pantalla
function MostrarReporte()
{
    //echo '<div class="wrap"><h1>'. __('Reporte SIGOES') .'</h1>';
    $vista = new ReporteView();
    //echo '</div>';
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

add_action( 'wp_enqueue_scripts', 'registrar_js' );
function registrar_js()
{    
    
    wp_register_script( 'jquery-ui', plugins_url(SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-ui.js') );
    wp_enqueue_script( 'jquery-ui' );
}

add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}
/*

                <link rel="stylesheet" href=<?php echo SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-ui.css'?>>
                <script src=<?php echo SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-1.9.1.js'?>></script>
                <script src=<?php echo SIGOES_PLUGIN_DIR.'/js/Calendario/jquery-ui.js' ?>></script> 
*/
?>