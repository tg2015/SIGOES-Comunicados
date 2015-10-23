<?php
class ContactoModel
{

 protected $CRUD;
 protected $tabla='contacto';
 		function __Construct(){
            global $wpdb;
            $this->CRUD=$wpdb;
        }

/*
public function insert_institucion($nombreInstitucion, $descripcionInstitucion, $telefonoInstitucion, $urlInstitucion, $direccionInstitucion)
{
    try {
        $this->CRUD->insert(
        $this->tabla, //table
        array('nombreInstitucion' => $nombreInstitucion,'descripcionInstitucion' => $descripcionInstitucion, 'telefonoInstitucion' => $telefonoInstitucion, 'urlInstitucion' => $urlInstitucion, 'direccionInstitucion' => $direccionInstitucion), //data
        array('%s','%s', '%s','%s','%s'));
        return  true;
        }
        catch (Exception $e)
        {
            return false;
        }
}

public function update_institucion($id, $nombreInstitucion, $descripcionInstitucion, $telefonoInstitucion, $urlInstitucion, $direccionInstitucion)
{
    try
        {
        $this->CRUD->update(
        $this->tabla, //table
        array('nombreInstitucion' => $nombreInstitucion,'descripcionInstitucion' => $descripcionInstitucion, 'telefonoInstitucion' => $telefonoInstitucion, 'urlInstitucion' => $urlInstitucion, 'direccionInstitucion' => $direccionInstitucion), //data
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

*/

public function delete_contacto($id)
{
	try{
        $this->CRUD->query($this->CRUD->prepare('DELETE FROM `'.$this->tabla.'` WHERE idContacto = %d',$id));
        return true;
    }
    catch (Exception $e)
    {
        return false;
    }
}

public function get_contactos($id)
{

    if(!is_null($id))
    {
        $resultados=$this->CRUD->get_results("SELECT * FROM ".$this->tabla." WHERE idInstitucion=".$id."  ORDER BY idContacto ASC");
        return $resultados;
    }

}

}