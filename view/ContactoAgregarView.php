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
		$idInstitucion = $_POST["idInstitucion"];
		$idContacto = $_POST["idContacto"];
		$nombre=$_POST["nombre"];
		$telefono=$_POST["telefono"];
		$email=$_POST["email"];
		$puesto=$_POST["puesto"];
		require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    	$institucionController = new InstitucionController();
    	
    	if($_POST['Actualizar'])
		{
		echo '<div class="updated highlight"><p>'.$nombre.' Actualizado</p></div>';
		if(!is_null($idContacto) and $institucionController->update_contacto($idContacto, $nombre, $telefono, $email, $puesto))
			{
			$this->EditarBorrar($idContacto);
			}
		}
		else if($_POST['Borrar'])
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
		else if($_POST['Guardar'])
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
			if(!is_null($idContacto))
			{
				$this->EditarBorrar($idContacto);
			}
			else
			{
				$this->Agregar($idInstitucion);
			}
		}

	}

	public function Agregar($idInstitucion)
	{
	echo '<h1>Agregar Contacto</h1>
	<div class="wrap">
	<table class="form-table">
	<form action="#" method="post">
	<td><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></td>
	<tr>
	<th><h3>&nbsp;Nombre Contacto: </h3></th>	<td><input type="text" value="'.$nombre.'" name="nombre" size=50 required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Telefono: </h3></th>				<td><input type="tel" value="'.$telefono.'" name="telefono" size=9 maxlength="9" id="phone"><span class="requerido"></span></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Email: </h3></th>				<td><input type="email" value="'.$email.'" name="email" size=50 required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Puesto: </h3></th>					<td><input type="text" value="'.$puesto.'" name="puesto" size=30></td>
	</tr>

	<tr>
	<th>
	<td><input id="guardar"  type="submit" value="Guardar"  class="button-primary" name="Guardar">&nbsp;&nbsp;</td>
	</th>
	<th><span class="requeridoNota">* Campos Requeridos</span></th>			<td></td>
	</tr>
	</form>
	<form action="admin.php?page=Contactos" method="post"><input id="regresar" type="submit" value="<< Regresar" name="<< Regresar" class="button-primary"><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"></form>
	</table>
	</div>
		';
	}

	public function EditarBorrar($idContacto)
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
	<th><h3>&nbsp;Nombre Contacto: </h3></th>	<td><input type="text" value="'.$nombre.'" name="nombre" size=50 required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Telefono: </h3></th>				<td><input type="tel" value="'.$telefono.'" name="telefono" size=9 maxlength="9" id="phone"><span class="requerido"></span></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Email: </h3></th>				<td><input type="email" value="'.$email.'" name="email" size=50 required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Puesto: </h3></th>					<td><input type="text" value="'.$puesto.'" name="puesto" size=30></td>
	</tr>

	<tr>
	<th>
	<td>';
	?>
	<input id="actualizar"	type="submit"	class="button-primary"  value="Actualizar"  name="Actualizar">&nbsp;&nbsp;
	<input id="borrar"		type='submit' 	class='button'			value='Borrar'		name="Borrar"  onclick="return confirm('Esta Seguro que desea borrar a: <?php echo $nombre; ?>')">&nbsp;&nbsp;	
	</td> 
	</th>
	<th><span class="requeridoNota">* Campos Requeridos</span></th>			<td></td>
	</tr>
	</form>
	<form action="admin.php?page=Contactos" method="post"><input type="hidden" value="<?php echo $idInstitucion;?>" name="idInstitucion"><input id="regresar" 	type="submit"  	class="button-primary" 	value="<< Regresar" name="<< Regresar"></form>
	</table>
	</div>
	<?php
		
	}

}