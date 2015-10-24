<?php
class InstitucionAgregarView
{
	function __Construct(){

        }

	public function MostrarVista()
	{
	$id = $_GET["id"];
	$nombre=$_POST["nombre"];
	$url=$_POST["url"];
	$telefono=$_POST["telefono"];
	$descripcion=$_POST["descripcion"];
	$direccion=$_POST["direccion"];
	require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();

	if($_POST['Actualizar'])
	{
		echo '<div class="updated highlight"><p>'.$nombre.' Actualizado</p></div>';
		if(!is_null($id) and $institucionController->update_institucion($id, $nombre, $descripcion, $telefono, $url, $direccion))
		{
		$this->EditarBorrar($id);
		}
	}
	else if($_POST['Borrar'])
	{	
		if(!is_null($id) and $institucionController->delete_institucion($id))
		{
		echo '<div class="updated highlight"><p>Institucion '.$nombre.' Borrada Exitosamente</p></div>
		&nbsp;&nbsp;
		<br/>
		<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones">
		';
		}
	}
	else if($_POST['Guardar'])
	{
		$last_id=($institucionController->insert_institucion($nombre, $descripcion, $telefono, $url, $direccion));
		echo '<div class="updated highlight"><p>Institucion Agregada Exitosamente</p></div>
		&nbsp;&nbsp;
		<br/>
		<table>
		<tr>
			<td><input type="button" value="Regresar" class="button-primary" onclick=location.href="admin.php?page=Instituciones"></td>
			<td><form method="post"><input id="AgregarContacto" 	type="button"  	class="button" 			value="Agregar Contacto" 	onclick=location.href="admin.php?page=Contactos&id='.$last_id.'"></form></td>
		</tr>
		</table>';
	}
	else
	{
		if(!is_null($id))
		{
			$this->EditarBorrar($id);
		}
		else
		{
			$this->Agregar();
		}
	}
	
	}

	public function Agregar()
	{
	echo '<h2>Agregar Institucion</h2>
	<div class="wrap">
	<table class="form-table">
	<form action="#" method="post">
	<tr>
		<td><input type="hidden" value="'.$id.'" name="id"  disabled></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Nombre Institucion: </h3></th>	<td><input type="text" value="'.$nombre.'" name="nombre" size=50 required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Telefono: </h3></th>					<td><input type="text" value="'.$telefono.'" name="telefono" size=9 maxlength="9" id="phone"></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Direccion: </h3></th>				<td><input type="text" value="'.$direccion.'" name="direccion" size=50 required maxlength="50"></td>
	<th> <h3>Url: </h3></th>						<td><input type="url" value="'.$url.'" name="url" required size=40 maxlength="50"><span class="requerido"></span></td>
	</tr>

	<tr>
	<th><h3>&nbsp;Descripcion: </h3></th>			<td><textarea rows="3" cols="50" name="descripcion">'.$descripcion.'</textarea></td>
	</tr>
	
	<tr>
	<th>
	<td><input id="guardar"  type="submit" value="Guardar"  class="button-primary" name="Guardar">&nbsp;&nbsp;
	<input id="regresar" type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones"></td>
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
    $institucion=$institucionController->get_institucion($id);
    foreach($institucion as $row)
    {
    	$nombre=$row->nombreInstitucion;
    	$descripcion=$row->descripcionInstitucion;
    	$telefono=$row->telefonoInstitucion;
    	$url=$row->urlInstitucion;
    	$direccion=$row->direccionInstitucion;
    }
	echo '<h2>Editar Institucion</h2>
	<div class="wrap">
	<table class="form-table">
	<form action="#" method="post">
	<tr>
	<th><h3>ID: </h3></th>					<td><input type="text" value="'.$id.'" name="id"  disabled></td>
	</tr>
	
	<tr>
	<th><h3>Nombre Institucion: </h3></th>	<td><input type="text" value="'.$nombre.'" name="nombre"  size=40 required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Telefono: </h3></th>			<td><input type="tel" value="'.$telefono.'" name="telefono" maxlength="9" id="phone"></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Direccion: </h3></th>		<td><input type="text" value="'.$direccion.'" name="direccion" size=50 required maxlength="50"></td>
	<th> <h3>Url: </h3></th>				<td><input type="url" value="'.$url.'" name="url" required size=40 maxlength="50"><span class="requerido"></span></td>
	</tr>
	
	<tr>
	<th><h3>Descripcion: </h3></th>			<td><textarea rows="3" cols="50" name="descripcion">'.$descripcion.'</textarea></td>
	</tr>

	<th>
	<td>';
	?>
	<input id="actualizar"	type="submit"	class="button-primary"  value="Actualizar"  name="Actualizar">&nbsp;&nbsp;
	<input id="contacto" 	type="button"  	class="button" 			value="Agregar Contacto" 	onclick=location.href="admin.php?page=Contactos&id=<?php echo $id; ?>">
	<input id="borrar"		type='submit' 	class='button'			value='Borrar'		name="Borrar"  onclick="return confirm('Esta Seguro que desea Borrar <?php echo $nombre; ?>')">&nbsp;&nbsp;
	<input id="regresar" 	type="button"  	class="button" 			value="Regresar" 	onclick=location.href="admin.php?page=Instituciones">
	</td> 
	</th>
	</tr>
	</form>
	</table>
	</div>
	<?php
	}

}
?>