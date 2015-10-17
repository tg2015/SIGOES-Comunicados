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

  function get_institucion($nombre)
	{
  	require_once(SIGOES_PLUGIN_DIR.'model/InstitucionModel.php');
  	$model=new InstitucionModel;
  	return $model->get_institucion($nombre);
	}

  function comprobar_estado_instituciones($nombre)
  {
    $resultados=$this->get_institucion($nombre);
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

}
?>