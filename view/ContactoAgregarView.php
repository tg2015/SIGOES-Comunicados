<?php
/*
*Nombre del módulo: ContactoAgregarView
*Objetivo: Agregar los contactos de cada institucion
*Dirección física: /SIGOES-Comunicados/view/ContactoAgregarView.php
*/
class ContactoAgregarView
{
	
	function __Construct(){

        }

	public function MostrarVista()
	{
		if(isset($_POST["idInstitucion"]))
			{$idInstitucion = $_POST["idInstitucion"];}
		if(isset($_POST["idContacto"]))
			{$idContacto = $_POST["idContacto"];}
		if(isset($_POST["nombre"]))
			{$nombre=$_POST["nombre"];}
		if(isset($_POST["telefono"]))
			{$telefono=$_POST["telefono"];}
		if(isset($_POST["email"]))
			{$email=$_POST["email"];}
		if(isset($_POST["puesto"]))
			{$puesto=$_POST["puesto"];}
		require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    	$institucionController = new InstitucionController();
    	
    	if(isset($_POST['Actualizar']))
		{
		echo '<div class="updated highlight"><p>'.$nombre.' Actualizado</p></div>';
		if(!is_null($idContacto) and $institucionController->update_contacto($idContacto, $nombre, $telefono, $email, $puesto))
			{
			$institucionController->EditarBorrarContacto($idContacto);
			}
		}
		else if(isset($_POST['Borrar']))
		{	
			$contacto=$institucionController->get_contacto($idContacto);
			foreach($contacto as $row)
    		{
    			$idInstitucion=$row->idInstitucion;
    		}
    		
			if(!is_null($idContacto) and $institucionController->delete_contacto($idContacto))
			{
			echo '<div class="updated highlight"><p>Contacto '.$nombre.' Borrado Exitosamente</p></div>
			&nbsp;&nbsp;
			<br/>
			<form method="post" action="admin.php?page=Contactos"><input type="submit" value="Regresar" class="button-primary"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></form>
			';
			}
			//<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Contactos&id='.$idRegresar.'">
		}
		else if(isset($_POST['Guardar']))
		{	
			if($institucionController->insert_contacto($idInstitucion, $nombre, $telefono, $email, $puesto))
			echo '<div class="updated highlight"><p>Contacto Agregado Exitosamente</p></div>
			&nbsp;&nbsp;
			<form method="post" action="admin.php?page=Contactos"><input type="submit" class="button" value="Regresar" name="Regresar"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></form>
			';
			//<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Contactos&id='.$idInstitucion.'">
		}
		else
		{
			//if(!is_null($idContacto))
			if(isset($_POST["idContacto"]))
			{
				$institucionController->EditarBorrarContacto($idContacto);
			}
			else
			{	
				$institucionController->AgregarContactoForm($idInstitucion);
			}
		}

	}

}