<?php
class ContactoAgregarView
{
	function __Construct(){

        }

	public function MostrarVista()
	{
		$idInstitucion = $_GET["idInstitucion"];
		$id = $_GET["id"];
		$nombre=$_POST["nombre"];
		$telefono=$_POST["telefono"];
		$email=$_POST["email"];
		$puesto=$_POST["puesto"];
		require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    	$institucionController = new InstitucionController();
    	
    	if($_POST['Actualizar'])
		{
		echo '<div class="updated highlight"><p>'.$nombre.' Actualizado</p></div>';
		if(!is_null($id) and $institucionController->update_contacto($id, $nombre, $telefono, $email, $puesto))
			{
			$this->EditarBorrar($id);
			}
		}
		else if($_POST['Borrar'])
		{	
			$contacto=$institucionController->get_contacto($id);
			foreach($contacto as $row)
    		{
    			$idRegresar=$row->idInstitucion;
    		}
    		
			if(!is_null($id) and $institucionController->delete_contacto($id))
			{
			echo '<div class="updated highlight"><p>Contacto '.$nombre.' Borrado Exitosamente</p></div>
			&nbsp;&nbsp;
			<br/>
			<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Contactos&id='.$idRegresar.'">
			';
			}
			//<form method="post" action="admin.php?page=Contactos"><input type="submit" value="Regresar" class="button"><input type="hidden" value="'.$idInstitucion.'" name="id"></form>
		}
		else if($_POST['Guardar'])
		{	
			if($institucionController->insert_contacto($idInstitucion, $nombre, $telefono, $email, $puesto))
			echo '<div class="updated highlight"><p>Contacto Agregado Exitosamente</p></div>
			&nbsp;&nbsp;
			<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Contactos&id='.$idInstitucion.'">
			';
			//<form method="post" action="admin.php?page=Contactos"><input type="submit" value="Regresar" class="button"><input type="hidden" value="'.$idInstitucion.'" name="id"></form>			
		}
		else
		{
			if(!is_null($id))
			{
				$this->EditarBorrar($id);
			}
			else
			{
				$this->Agregar($idInstitucion);
			}
		}

	}

	public function Agregar($idInstitucion)
	{
	echo '<h2>Agregar Contacto</h2>
	<div class="wrap">
	<table class="form-table">
	<form action="#" method="post">
	<td><input type="hidden" value="'.$idInstitucion.'" name="idInstitucion"  disabled></td>
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
	<td><input id="guardar"  type="submit" value="Guardar"  class="button-primary" name="Guardar">&nbsp;&nbsp;
	<input id="regresar" type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Contactos&id='.$idInstitucion.'"></td>
	</th>
	</tr>
	</form>
	</table>
	</div>
		';
	}

	public function EditarBorrar($id)
	{
	require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();
    $contacto=$institucionController->get_contacto($id);
    foreach($contacto as $row)
    {
    	$idInstitucion=$row->idInstitucion;
    	$nombre=$row->nombreContacto;
    	$telefono=$row->telefonoContacto;
    	$email=$row->emailContacto;
    	$puesto=$row->puestoContacto;
    }
	echo '<h2>Editar Contacto</h2>
	<div class="wrap">
	<table class="form-table">
	<form action="#" method="post">
	<input type="hidden" value="'.$id.'" name="id"  disabled>
	<input type="hidden" value="'.$idInstitucion.'" name="idRegresar"  disabled>
	<input type="hidden" value="1000000000" name="posteado"  disabled>
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
	<input id="regresar" 	type="button"  	class="button" 			value="Regresar" 	onclick=location.href="admin.php?page=Contactos&id=<?php echo $idInstitucion;?>">
	</td> 
	</th>
	</tr>
	</form>
	</table>
	</div>
	<?php
		
	}

}