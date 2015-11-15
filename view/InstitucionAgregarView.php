<?php
/*
*Nombre del módulo: InstitucionAgregarView
*Objetivo: Agregar las instituciones que se encuentran implementando el plugin-sigoes
*Dirección física: /SIGOES-Comunicados/view/InstitucionAgregarView.php
*/
class InstitucionAgregarView
{
	function __Construct(){

        }

	public function MostrarVista()
	{
	if(isset($_POST["idInstitucion"]))
		{$idInstitucion = $_POST["idInstitucion"];}
	if(isset($_POST["nombre"]))
		{$nombre=$_POST["nombre"];}
	if(isset($_POST["url"]))
		{$url=$_POST["url"];}
	if(isset($_POST["telefono"]))
		{$telefono=$_POST["telefono"];}
	if(isset($_POST["descripcion"]))
		{$descripcion=$_POST["descripcion"];}
	if(isset($_POST["direccion"]))
		{$direccion=$_POST["direccion"];}
	require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();

	if(isset($_POST['Actualizar']))
	{
		echo '<div class="updated highlight"><p>'.$nombre.' Actualizado</p></div>';
		if(!is_null($idInstitucion) and $institucionController->update_institucion($idInstitucion, $nombre, $descripcion, $telefono, $url, $direccion))
		{
		$institucionController->EditarBorrar($idInstitucion);
		}
	}
	else if(isset($_POST['Borrar']))
	{	
		if(!is_null($idInstitucion) and $institucionController->delete_institucion($idInstitucion))
		{
		echo '<div class="updated highlight"><p>Institucion '.$nombre.' Borrada Exitosamente</p></div>
		&nbsp;&nbsp;
		<br/>
		<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones">
		';
		}
	}
	else if(isset($_POST['Guardar']))
	{
		$idInstitucion=($institucionController->insert_institucion($nombre, $descripcion, $telefono, $url, $direccion));
		echo '<div class="updated highlight"><p>Institucion '.$nombre.' Agregada Exitosamente</p></div>
		&nbsp;&nbsp;
		<br/>
		<table>
		<tr>
			<td><input type="button" value="<< Regresar" class="button-primary" onclick=location.href="admin.php?page=Instituciones"></td>
			<td><form action="admin.php?page=Contactos" method="post"><input id="AgregarContacto" 	type="submit"  	class="button" 	value="Agregar Contacto" name="Agregar Contacto"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></form></td>	
		</tr>
		</table>';
	}
	else
	{
		//if(!is_null($idInstitucion))
		if(isset($_POST["idInstitucion"]))
		{
			$institucionController->EditarBorrar($idInstitucion);
		}
		else
		{
			$institucionController->AgregarInstitucionForm();
		}
	}
	
	}

}
?>