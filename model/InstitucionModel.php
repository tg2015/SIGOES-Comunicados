<?php
/*
*Nombre del módulo: InstitucionModel
*Objetivo: Model de de Institucion
*Dirección física: /SIGOES-Comunicados/model/InstitucionModel.php
*/
class InstitucionModel
{

 protected $CRUD;
 protected $usuario;
 protected $tabla='institucion';
 		function __Construct(){
            global $wpdb;
            $this->CRUD=$wpdb;
            $this->usuario=wp_get_current_user();
            $this->tabla=$wpdb->prefix.$this->tabla;
        }

public function get_instituciones($nombre)
{
if(!is_null($nombre))
{
	$filtro="WHERE nombreInstitucion LIKE '%".$nombre."%'";
}
else
{
	$filtro="";
}
$resultados=$this->CRUD->get_results("SELECT * FROM ".$this->tabla." ".$filtro);
return $resultados;
}

public function get_institucion($id)
{

if(!is_null($id))
{
$resultados=$this->CRUD->get_results("SELECT * FROM ".$this->tabla." WHERE idInstitucion=".$id);
return $resultados;
}

}


public function insert_institucion($nombreInstitucion, $descripcionInstitucion, $telefonoInstitucion, $urlInstitucion, $direccionInstitucion)
{
    try {
        $this->CRUD->insert(
        $this->tabla, //table
        array('nombreInstitucion' => $nombreInstitucion,'descripcionInstitucion' => $descripcionInstitucion, 'telefonoInstitucion' => $telefonoInstitucion, 'urlInstitucion' => $urlInstitucion, 'direccionInstitucion' => $direccionInstitucion, 'idUsuario' => $this->usuario->ID), //data
        array('%s','%s', '%s','%s','%s', '%s'));
        $lastid = $this->CRUD->insert_id;
            return  $lastid;
        }
        catch (Exception $e)
        {
            return 0;
        }
}

public function update_institucion($id, $nombreInstitucion, $descripcionInstitucion, $telefonoInstitucion, $urlInstitucion, $direccionInstitucion)
{
    try
        {
        $this->CRUD->update(
        $this->tabla, //table
        array('nombreInstitucion' => $nombreInstitucion,'descripcionInstitucion' => $descripcionInstitucion, 'telefonoInstitucion' => $telefonoInstitucion, 'urlInstitucion' => $urlInstitucion, 'direccionInstitucion' => $direccionInstitucion, 'idUsuario' => $this->usuario->ID), //data
        array( 'idInstitucion' => $id ), //where
        array('%s', '%s', '%s', '%s', '%s'), //data format
        array('%s')); //where format
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
}

public function delete_institucion($id)
{
	try{
    $this->CRUD->query($this->CRUD->prepare('DELETE FROM `'.$this->tabla.'` WHERE idInstitucion = %d',$id));
    return true;
    }
    catch (Exception $e)
    {
    return false;
    }
}

public function update_estadoConexion($id, $estadoInstitucion, $estadoPlugin)
{
    try
        {
        $this->CRUD->update(
        $this->tabla, //table
        array('estadoInstitucion' => $estadoInstitucion, 'estadoPlugin' => $estadoPlugin), //data
        array( 'idInstitucion' => $id ), //where
        array('%s', '%s'), //data format
        array('%s')); //where format
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
}

}