<?php
/*
*Nombre del módulo: InstitucionController
*Objetivo: Controlador para Institucion y Contacto
*Dirección física: /SIGOES-Comunicados/controller/InstitucionController.php
*/
function Activar_Menu_Instituciones()
{
   add_menu_page('Instituciones', 'Instituciones', 'manage_options', 'Instituciones', 'MostrarInstituciones', 'dashicons-building');
   add_submenu_page('Instituciones', 'Agregar Institucion', 'Agregar Institucion', 'manage_options', 'AgregarInstitucion', 'AgregarInstitucion');
   add_submenu_page('null', 'Contactos', 'Contactos', 'manage_options', 'Contactos', 'MostrarContactos', 'Contactos');
   add_submenu_page('null', 'AgregarContacto', 'AgregarContacto', 'manage_options', 'AgregarContacto', 'AgregarContacto', 'Contactos');
   add_submenu_page('null', 'ReporteXML', 'ReporteXML', 'manage_options', 'ReporteXML', 'ReporteXML', 'ReporteXML');
}
add_action('admin_menu', 'Activar_Menu_Instituciones');

add_action( 'admin_enqueue_scripts', 'registrar_css' );
function registrar_css() 
{
    wp_register_style( 'EstilosInstitucion', plugins_url('SIGOES-Comunicados/includes/css/EstilosInstitucion.css'));
    wp_enqueue_style( 'EstilosInstitucion' );     
}

add_action( 'in_admin_header', 'registrar_encabezado' );
function registrar_encabezado()
{       
    wp_register_style( 'EstilosAdmin', plugins_url('SIGOES-Comunicados/includes/css/EstilosAdmin.css'));
    wp_enqueue_style( 'EstilosAdmin' );

    echo '<div class="encabezado">
          <img id="logo"    src="'.plugins_url().'/SIGOES-Comunicados/includes/img/gob.jpg">
          <img id="escudo"  src="'.plugins_url().'/SIGOES-Comunicados/includes/img/presidencia.jpg">
          <div class="titulo-sistema"><br/><p>Sistema Informático para la Gestión de Gobierno Electrónico en la Innovación de Canales de Comunicación entre Casa Presidencial y Población Salvadoreña (SIGOES)</p><br/></div>                    
          </div>
          ';
}

function MostrarInstituciones()
{
  require_once(SIGOES_PLUGIN_DIR.'view/InstitucionView.php');
  echo '<div class="wrap">';
  $vista=new InstitucionView;
  echo '</div>';
}

function MostrarContactos()
{
  require_once(SIGOES_PLUGIN_DIR.'view/ContactoView.php');
  echo '<div class="wrap">';
  $vista=new ContactoView;
  echo '</div>';
}

function AgregarContacto()
{
  require_once(SIGOES_PLUGIN_DIR.'view/ContactoAgregarView.php');
  $vista=new ContactoAgregarView;
  $vista->MostrarVista();
}

function AgregarInstitucion()
{
  require_once(SIGOES_PLUGIN_DIR.'view/InstitucionAgregarView.php');
  $vista=new InstitucionAgregarView;
  $vista->MostrarVista();
}

function ReporteXML()
{
  require_once(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporte.php');
}

add_action( 'in_admin_footer', 'registrar_jsmask' );
function registrar_jsmask()
{       
    wp_register_script( 'ValidacionMascara', plugins_url('SIGOES-Comunicados/includes/js/ValidacionMascara.js'), array( 'jquery' ) );
    wp_enqueue_script( 'ValidacionMascara' );
    
    ?> 
    <script>
      jQuery(function($){
      $("#fecha_ini").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
      $("#fecha_fin").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
      $("#phone").mask("9999-9999");
      $("#tin").mask("99-9999999");
      $("#ssn").mask("999-99-9999");
      });
    </script>
    <script type="text/javascript">
                    $(document).ready(function (){
                    $("#loading-div-background").css({ opacity: 1.0 });
                    });

                    function ShowProgressAnimation(){
                    $("#loading-div-background").show();
                    }
    </script>
    <?php
}

class InstitucionController
{
	function __Construct(){
        
        }

  function get_instituciones($nombre)
	{
  	require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
  	$model=new InstitucionModel;
  	return $model->get_instituciones($nombre);
	}

  function get_institucion($id)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->get_institucion($id);
  }

  function comprobar_estado_instituciones($nombre)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;

    $resultados=$this->get_instituciones($nombre);
    require_once(SIGOES_PLUGIN_DIR.'includes/Rss.php');
    $rss=new Rss;
    foreach ($resultados as $row) 
    {
      $url=$row->urlInstitucion;
      if($rss->chequearUrl($url.'/feed'))
        {
          $row->estadoInstitucion='Accesible';
          if($rss->verificarPlugin($url.'/feed'))
          {$row->estadoPlugin='Instalado';}
          else
          {$row->estadoPlugin='No Instalado';}
        }
      else{$row->estadoInstitucion='Inaccesible';
            $row->estadoPlugin='Sin Comprobar';}
      
      $model->update_estadoConexion($row->idInstitucion, $row->estadoInstitucion, $row->estadoPlugin);
    }
    return $resultados;
  }

  function delete_institucion($id)
  {
    if(!is_null($id))
    {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->delete_institucion($id);
    }
  }

  function update_institucion($id, $nombre, $descripcion, $telefono, $url, $direccion)
  {
    if(!is_null($id))
    {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->update_institucion($id, $nombre, $descripcion, $telefono, $url, $direccion);
    }
  }

  function insert_institucion($nombre, $descripcion, $telefono, $url, $direccion)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->insert_institucion($nombre, $descripcion, $telefono, $url, $direccion);
  }
  
  /*
  *Funciones de Controlador utilizadas para realizar CRUD de Contactos
  */

  function get_contactos($id)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/ContactoModel.php');
    $model=new ContactoModel;
    return $model->get_contactos($id);
  }

  function get_contacto($id)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/ContactoModel.php');
    $model=new ContactoModel;
    return $model->get_contacto($id);
  }

  function delete_contacto($id)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/ContactoModel.php');
    $model=new ContactoModel;
    return $model->delete_contacto($id);
  }

  function insert_contacto($idInstitucion, $nombre, $telefono, $email, $puesto)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/ContactoModel.php');
    $model=new ContactoModel;
    return $model->insert_contacto($idInstitucion, $nombre, $telefono, $email, $puesto);
  }

  function update_contacto($id, $nombre, $telefono, $email, $puesto)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/ContactoModel.php');
    $model=new ContactoModel;
    return $model->update_contacto($id, $nombre, $telefono, $email, $puesto);
  }

}
?>