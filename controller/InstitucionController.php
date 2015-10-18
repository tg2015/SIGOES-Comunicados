<?php
function Activar_Menu_Instituciones()
{
   add_menu_page('Instituciones', 'Instituciones', 'manage_options', 'Instituciones', 'MostrarInstituciones');
   add_submenu_page('Instituciones', 'Agregar Institucion', 'Agregar Institucion', 'manage_options', 'AgregarInstitucion', 'AgregarInstitucion');
}
add_action('admin_menu', 'Activar_Menu_Instituciones');

function MostrarInstituciones()
{
  require_once(SIGOES_PLUGIN_DIR.'view/InstitucionView.php');
  echo '<div class="wrap">';
  $vista=new InstitucionView;
  echo '</div>';
}

function AgregarInstitucion()
{
  require_once(SIGOES_PLUGIN_DIR.'view/InstitucionAgregarView.php');
  $vista=new InstitucionAgregarView;
  $vista->MostrarVista();
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
    $resultados=$this->get_instituciones($nombre);
    require_once(SIGOES_PLUGIN_DIR.'includes/Rss.php');
    $rss=new Rss;
    foreach ($resultados as $row) 
    {
      $url=$row->urlInstitucion;
      if($rss->chequearUrl($url.'/feed'))
        {
          $row->Estado='Activo';
          if($rss->verificarPlugin($url.'/feed'))
          {$row->Plugin='Instalado';}
        }
      else{$row->Estado='Inactivo';}
    }
    return $resultados;
  }

  function borrar_institucion($id)
  {
    if(!is_null($id))
    {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->borrar_institucion($id);
    }
  }

  function update_institucion($id, $nombre, $descripcion, $telefono, $url)
  {
    if(!is_null($id))
    {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->update_institucion($id, $nombre, $descripcion, $telefono, $url);
    }
  }

  function insert_institucion($nombre, $descripcion, $telefono, $url)
  {
    require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
    $model=new InstitucionModel;
    return $model->insert_institucion($id, $nombre, $descripcion, $telefono, $url);
  }

}
?>