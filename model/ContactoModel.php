<?php
/*
*Nombre del módulo: ContactoModel
*Objetivo: Model de de Conctato
*Dirección física: /SIGOES-Comunicados/model/ContactoModel.php
*/
class ContactoModel
{

 protected $CRUD;
 protected $tabla='contacto';
 		function __Construct(){
            global $wpdb;
            $this->CRUD=$wpdb;
        }

public function update_contacto($id, $nombreContacto, $telefonoContacto, $emailContacto, $puestoContacto)
{
    try
        {
        $this->CRUD->update(
        $this->tabla, //table
        array('nombreContacto' => $nombreContacto,'telefonoContacto' => $telefonoContacto, 'emailContacto' => $emailContacto, 'puestoContacto' => $puestoContacto), //data
        array( 'idContacto' => $id ), //where
        array('%s', '%s', '%s', '%s'), //data format
        array('%s')); //where format
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
}

public function insert_contacto($idInstitucion, $nombreContacto, $telefonoContacto, $emailContacto, $puestoContacto)
{
    try {
        $this->CRUD->insert(
        $this->tabla, //table
        array('idInstitucion' => $idInstitucion, 'nombreContacto' => $nombreContacto,'telefonoContacto' => $telefonoContacto, 'emailContacto' => $emailContacto, 'puestoContacto' => $puestoContacto), //data
        array('%s','%s', '%s','%s','%s'));
        return  true;
        }
        catch (Exception $e)
        {
            return false;
        }
}


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
        $resultados=$this->CRUD->get_results("SELECT * FROM ".$this->tabla." WHERE idInstitucion=".$id."  ORDER BY idContacto DESC");
        return $resultados;
    }

}

public function get_contacto($id)
{

    if(!is_null($id))
    {
        $resultados=$this->CRUD->get_results("SELECT * FROM ".$this->tabla." WHERE idContacto=".$id);
        return $resultados;
    }

}

}