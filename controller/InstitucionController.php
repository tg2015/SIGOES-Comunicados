<?php
/*
*Nombre del módulo: InstitucionController
*Objetivo: Controlador para Institucion y Contacto
*Dirección física: /SIGOES-Comunicados/controller/InstitucionController.php
*/
function Activar_Menu_Instituciones()
{
   add_menu_page('Parametros de Conexión', 'Parametros de Conexión', 'manage_options', 'Instituciones', 'MostrarInstituciones', 'dashicons-building', 50);
   add_submenu_page('Instituciones', 'Agregar Institucion', 'Agregar Institucion', 'manage_options', 'AgregarInstitucion', 'AgregarInstitucion');
   add_submenu_page('null', 'Contactos', 'Contactos', 'manage_options', 'Contactos', 'MostrarContactos', 'Contactos');
   add_submenu_page('null', 'AgregarContacto', 'AgregarContacto', 'manage_options', 'AgregarContacto', 'AgregarContacto', 'Contactos');
   add_submenu_page('null', 'ReporteInstituciones', 'ReporteInstituciones', 'manage_options', 'ReporteInstituciones', 'ReporteInstituciones', 'ReporteInstituciones');
}
add_action('admin_menu', 'Activar_Menu_Instituciones');

add_action( 'admin_enqueue_scripts', 'registrar_EstilosInstitucion' );
function registrar_EstilosInstitucion() 
{
    wp_register_style( 'EstilosInstitucion', plugins_url('SIGOES-Comunicados/includes/css/EstilosInstitucion.css'));
    wp_enqueue_style( 'EstilosInstitucion' );     
}

add_action( 'admin_enqueue_scripts', 'registrar_ValidacionMascara' );
function registrar_ValidacionMascara()
{   
      if(isset($_GET["page"]))
      {
      $pagina = $_GET["page"];
      if("AgregarContacto"==$pagina || "AgregarInstitucion"==$pagina || "Reporte_SIGOES"==$pagina)
        {
        //echo '<script type="text/javascript">alert("'.$pagina.'");</script>';
        EncolarValidacionMascara();
        }
      }
}

function EncolarValidacionMascara()
{
  wp_register_script( 'ValidacionMascara', plugins_url('SIGOES-Comunicados/includes/js/ValidacionMascara.js'), array( 'jquery' ) );
  wp_enqueue_script( 'ValidacionMascara' );    
}

add_action( 'in_admin_footer', 'registrar_ValidacionMascaraScript' );
function registrar_ValidacionMascaraScript()
{
  if(isset($_GET["page"]))
  {
  $pagina = $_GET["page"];
  if("AgregarContacto"==$pagina || "AgregarInstitucion"==$pagina || "Reporte_SIGOES"==$pagina || "Instituciones"==$pagina)
  {
  ?> 
    <script>
      (function ($) {
      $("#fecha_ini").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
      $("#fecha_fin").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
      $("#phone").mask("9999-9999");
      $("#tin").mask("99-9999999");
      $("#ssn").mask("999-99-9999");
      }(jQuery));
    </script>
    <script>
      function soloLetras(e) {
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
      especiales = [8, 9, 44, 46];

      tecla_especial = false
      for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
      }

      if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
      }

    function limpia() {
      var val = document.getElementById("miInput").value;
      var tam = val.length;
      for(i = 0; i < tam; i++) {
          if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
        }
      }

    
    jQuery(document).ready(function() {
      jQuery( document ).on( 'click', '#guardar', function(){
        var nombre = jQuery.trim(jQuery('#nombre').val());
        var telefono = jQuery.trim(jQuery('#phone').val());
        if (nombre == null || nombre.trim() == ""){
          alert("Debe llenar el campo nombre");
          return false;
          }
        if (telefono == null || telefono.length < 9){
          alert("el campo telefono debe tener 8 digitos");
          return false;
          }
        
      });

      jQuery( document ).on( 'click', '#actualizar', function(){
        var nombre = jQuery.trim(jQuery('#nombre').val());
        var telefono = jQuery.trim(jQuery('#phone').val());
        if (nombre == null || nombre.trim() == ""){
          alert("Debe llenar el campo nombre");
          return false;
          }
        if (telefono == null || telefono.length < 9){
          alert("el campo telefono debe tener 8 digitos");
          return false;
          }
        
      });

    });  
    </script>
    <script type="text/javascript">
                    jQuery(document).ready(function (){
                    jQuery("#loading-div-background").css({ opacity: 1.0 });
                    });

                    function ShowProgressAnimation(){
                    jQuery("#loading-div-background").show();
                    }
      </script>

    <?php
    }
    elseif ("Instituciones"==$pagina) {
      ?>
      <script type="text/javascript">
                    jQuery(document).ready(function (){
                    jQuery("#loading-div-background").css({ opacity: 1.0 });
                    });

                    function ShowProgressAnimation(){
                    jQuery("#loading-div-background").show();
                    }
      </script>
      <?php
    }

    }
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

function ReporteInstituciones()
{
  require_once(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporteInstituciones.php');
}

/*Clase Institucion Controller*/
class InstitucionController
{
	function __Construct(){
        
        }
  /*
  *Funciones de Controlador utilizadas para realizar CRUD de Instituciones
  */ 

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

  public function AgregarInstitucionForm()
  {
    $idInstitucion  =''; $nombre    ='';
    $telefono     =''; $direccion   ='';
    $url      =''; $descripcion   ='';
  echo '<h1>Agregar Institución</h1>
  <div class="wrap">
  <table class="form-table">
  <form action="#" method="post">  
  <tr>
    <td><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"  disabled></td>
  </tr>
  
  <tr>
  <th><h3>&nbsp;Nombre Institución: <span class="description">(requerido)</span></h3></th>  <td><input type="text" value="'.$nombre.'" name="nombre" id="nombre" size=37 required maxlength="100" onkeypress="return soloLetras(event)"><span class="requerido"></span></td>
  <th><h3>Teléfono: <span class="description">(requerido)</span></h3></th>          <td><input type="text" value="'.$telefono.'" name="telefono" size=9 maxlength="9" id="phone" required><span class="requerido"></span></td>
  </tr>
  
  <tr>
  <th><h3>&nbsp;Dirección: </h3><span class="description">(requerido)</span></th>       <td><input type="text" value="'.$direccion.'" name="direccion" id="direccion" size=37 required maxlength="100"><span class="requerido"></span></td>
  <th><h3>Url: </h3><span class="description">(requerido)</span></th>           <td><input type="url" value="'.$url.'" name="url" required size=37 maxlength="100" placeholder="http://www.institucion.gob.sv"><span class="requerido"></span></td>
  </tr>

  <tr>
  <th><h3>&nbsp;Descripción: </h3></th>     <td><textarea rows="3" cols="40" name="descripcion">'.$descripcion.'</textarea></td>
  </tr>
  
  <tr>
  <th>
  <td><input id="guardar"  type="submit" value="Guardar"  class="button-primary" name="Guardar">&nbsp;&nbsp;
  <input id="regresar" type="button" value="<< Regresar" class="button" name="<< Regresar" onclick=location.href="admin.php?page=Instituciones"></td>
  </th>
  <th><span class="requeridoNota">* Campos Requeridos</span></th>     <td></td>
  </tr>
  </form>
  </table>
  </div>
  ';

  }

  public function EditarBorrar($idInstitucion)
  {
  //require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    //$institucionController = new InstitucionController();
    $institucion=$this->get_institucion($idInstitucion);
    foreach($institucion as $row)
    {
      $nombre=$row->nombreInstitucion;
      $descripcion=$row->descripcionInstitucion;
      $telefono=$row->telefonoInstitucion;
      $url=$row->urlInstitucion;
      $direccion=$row->direccionInstitucion;
    }
  echo '<form method="post" action="admin.php?page=Contactos"><h1>Editar Institución
  <input id="contacto"  type="submit"   class="button-primary"      value="Agregar Contacto" name="Agregar Contacto"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"> 
  </h1></form>
  <div class="wrap">
  <table class="form-table">
  <form action="#" method="post" onSubmit="return validateForm(this)">
  <tr>
  <td><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></td>
  </tr>
  
  <tr>
  <th><h3>Nombre Institución: <span class="description">(requerido)</span></h3></th>  <td><input type="text" value="'.$nombre.'" name="nombre" id="nombre" size=40 required maxlength="100" onkeypress="return soloLetras(event)"><span class="requerido"></span></td>
  <th><h3>Teléfono: <span class="description">(requerido)</span></h3></th>      <td><input type="tel" value="'.$telefono.'" name="telefono" maxlength="9" id="phone" required><span class="requerido"></span></td>
  </tr>
  
  <tr>
  <th><h3>&nbsp;Dirección: <span class="description">(requerido)</span></h3></th>   <td><input type="text" value="'.$direccion.'" name="direccion" id="direccion" size=40 required maxlength="100"><span class="requerido"></span></td>
  <th><h3>Url: <span class="description">(requerido)</span></h3></th>       <td><input type="url" value="'.$url.'" name="url" required size=40 maxlength="100" placeholder="http://www.institucion.gob.sv"><span class="requerido"></span></td>
  </tr>
  
  <tr>
  <th><h3>Descripción: </h3></th>     <td><textarea rows="3" cols="40" name="descripcion">'.$descripcion.'</textarea></td>
  </tr>

  <th>
  <td>';
  ?>
  <input id="actualizar"  type="submit" class="button-primary"  value="Actualizar"  name="Actualizar">&nbsp;&nbsp;  
  <input id="borrar"    type='submit'   class='button'      value='Borrar'    name="Borrar"  onclick="return confirm('Esta Seguro que desea Borrar <?php echo $nombre; ?>')">&nbsp;&nbsp;
  <input id="regresar"  type="button"   class="button"      value="<< Regresar"   onclick=location.href="admin.php?page=Instituciones">
  </td> 
  </th>
  <th><span class="requeridoNota">* Campos Requeridos</span></th>     <td></td>
  </tr>
  </form>
  
  </table>
  </div>
  <?php
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

  public function AgregarContactoForm($idInstitucion)
  {
  $nombre     =''; $telefono    =''; 
  $email      =''; $puesto    ='';

  echo '<h1>Agregar Contacto</h1>
  <div class="wrap">
  <table class="form-table">
  <form action="#" method="post">
  <td><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></td>
  <tr>
  <th><h3>&nbsp;Nombre Contacto: <span class="description">(requerido)</span></h3></th> <td><input type="text" value="'.$nombre.'" id="nombre" name="nombre" size=40 required maxlength="50" onkeypress="return soloLetras(event)"><span class="requerido"></span></td>
  <th><h3>Teléfono: <span class="description">(requerido)</span></h3></th>        <td><input type="tel" value="'.$telefono.'" name="telefono" size=9 maxlength="9" id="phone" required><span class="requerido"></span></td>
  </tr>
  
  <tr>
  <th><h3>&nbsp;Email: <span class="description">(requerido)</span></h3></th>       <td><input type="email" value="'.$email.'" id="email" name="email" size=40 required maxlength="50"><span class="requerido"></span></td>
  <th><h3>Puesto: </h3></th>          <td><input type="text" value="'.$puesto.'" name="puesto" size=30></td>
  </tr>

  <tr>
  <th>
  <td><input id="guardar"  type="submit" value="Guardar"  class="button-primary" name="Guardar">&nbsp;&nbsp;</td>
  </th>
  <th><span class="requeridoNota">* Campos Requeridos</span></th>     <td></td>
  </tr>
  </form>
  <form action="admin.php?page=Contactos" method="post"><input id="regresar" type="submit" value="<< Regresar" name="<< Regresar" class="button-primary"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></form>
  </table>
  </div>
    ';
  }

  public function EditarBorrarContacto($idContacto)
  {
  require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();
    $contacto=$institucionController->get_contacto($idContacto);
    foreach($contacto as $row)
    {
      $idInstitucion=$row->idInstitucion;
      $nombre=$row->nombreContacto;
      $telefono=$row->telefonoContacto;
      $email=$row->emailContacto;
      $puesto=$row->puestoContacto;
    }
  echo '<h1>Editar Contacto</h1>
  <div class="wrap">
  <table class="form-table">
  <form action="admin.php?page=AgregarContacto" method="post">
  <input type="hidden" value="'.$idContacto.'" name="idContacto"  >
  <input type="hidden" value="'.$idInstitucion.'" name="idRegresar">
  <tr>
  <th><h3>&nbsp;Nombre Contacto: <span class="description">(requerido)</span></h3></th> <td><input type="text" value="'.$nombre.'" id="nombre" name="nombre" size=40 required maxlength="50" onkeypress="return soloLetras(event)"><span class="requerido"></span></td>
  <th><h3>Teléfono: <span class="description">(requerido)</span></h3></th>        <td><input type="tel" value="'.$telefono.'" name="telefono" size=9 maxlength="9" id="phone" required><span class="requerido"></span></td>
  </tr>
  
  <tr>
  <th><h3>&nbsp;Email: <span class="description">(requerido)</span></h3></th>       <td><input type="email" value="'.$email.'" name="email" size=40 required maxlength="50"><span class="requerido"></span></td>
  <th><h3>Puesto: </h3></th>          <td><input type="text" value="'.$puesto.'" name="puesto" size=30></td>
  </tr>

  <tr>
  <th>
  <td>';
  ?>
  <input id="actualizar"  type="submit" class="button-primary"  value="Actualizar"  name="Actualizar">&nbsp;&nbsp;
  <input id="borrar"    type='submit'   class='button'      value='Borrar'    name="Borrar"  onclick="return confirm('Esta Seguro que desea borrar a: <?php echo $nombre; ?>')">&nbsp;&nbsp;  
  </td> 
  </th>
  <th><span class="requeridoNota">* Campos Requeridos</span></th>     <td></td>
  </tr>
  </form>
  <form action="admin.php?page=Contactos" method="post"><input type="hidden" value="<?php echo $idInstitucion;?>" name="idInstitucion"><input id="regresar"   type="submit"   class="button-primary"  value="<< Regresar" name="<< Regresar"></form>
  </table>
  </div>
  <?php
    
  }


}
?>