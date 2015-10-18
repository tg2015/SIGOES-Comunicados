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
	require_once(SIGOES_PLUGIN_DIR.'/controller/InstitucionController.php');
    $institucionController = new InstitucionController();

	if($_POST['Actualizar'])
	{
		echo '<div class="updated highlight"><p>'.$nombre.' Actualizado</p></div>';
		if(!is_null($id) and $institucionController->update_institucion($id, $nombre, $descripcion, $telefono, $url))
		{
		$this->EditarBorrar($id);
		}
	}
	else if($_POST['Borrar'])
	{	
		if(!is_null($id) and $institucionController->borrar_institucion($id))
		{
		echo '<div class="updated highlight"><p>Institucion '.$nombre.' Borrada Exitosamente</p></div>
		&nbsp;&nbsp;
		<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones">
		';
		}
	}
	else if($_POST['Guardar'])
	{
		if($institucionController->insert_institucion($id, $nombre, $descripcion, $telefono, $url))
		echo '<div class="updated highlight"><p>Institucion Agregada Exitosamente</p></div>
		&nbsp;&nbsp;
		<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones">
		';
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
	echo '<h1>Agregar Institucion</h1>
	<div class="wrap">
	<table class="form-table">
	<form action="" method="post">
	<tr>
	<th><h3>&nbsp;ID: </h3></th>					<td><input type="text" value="'.$id.'" name="id"  disabled></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Nombre Institucion: </h3></th>	<td><input type="text" value="'.$nombre.'" name="nombre" required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Telefono: </h3></th>					<td><input type="tel" value="'.$telefono.'" name="telefono" maxlength="8"></td>
	</tr>
	
	<tr>
	<th><h3>&nbsp;Descripcion: </h3></th>			<td><textarea rows="3" cols="50" name="descripcion">'.$descripcion.'</textarea></td>
	<th> <h3>Url: </h3></th>						<td><input type="url" value="'.$url.'" name="url" required size=40 maxlength="50"><span class="requerido"></span></td>
	</tr>
	
	<tr>
	<th>
	&nbsp;<input id="guardar" class="button-primary" type="submit" value="Guardar" name="Guardar">&nbsp;&nbsp;
	<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones">
	</th>
	</tr>
	</form>
	</table>
	</div>';
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
    }
	echo '<h1>Editar Institucion</h1>
	<div class="wrap">
	<table class="form-table">
	<form action="" method="post">
	<tr>
	<th><h3>ID: </h3></th>					<td><input type="text" value="'.$id.'" name="id"  disabled></td>
	</tr>
	
	<tr>
	<th><h3>Nombre Institucion: </h3></th>	<td><input type="text" value="'.$nombre.'" name="nombre" required maxlength="50"><span class="requerido"></span></td>
	<th><h3>Telefono: </h3></th>			<td><input type="tel" value="'.$telefono.'" name="telefono" maxlength="8"></td>
	</tr>
	
	<tr>
	<th><h3>Descripcion: </h3></th>			<td><textarea rows="3" cols="50" name="descripcion">'.$descripcion.'</textarea></td>
	<th> <h3>Url: </h3></th>				<td><input type="url" value="'.$url.'" name="url" required size=40 maxlength="50"><span class="requerido"></span></td>
	</tr>

	<th>
	&nbsp;<input id="actualizar" class="button-primary" type="submit" value="Actualizar" name="Actualizar">&nbsp;&nbsp;
	<input id="borrar" class="button" type="submit" value="Borrar" name="Borrar">
	<input type="button" value="Regresar" class="button" onclick=location.href="admin.php?page=Instituciones">
	</th>
	</tr>
	</form>
	</table>
	</div>';
	}

}
?>