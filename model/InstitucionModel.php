<?php

class InstitucionModel
{

 protected $CRUD;
 protected $tabla='institucion';
 function __Construct(){
            global $wpdb;
            $this->CRUD=$wpdb;
        }

public function get_institucion()
{
$resultados=$this->CRUD->get_results("SELECT * FROM ".$this->tabla);
return $resultados;
}

public function insert_institucion()
{

}

public function update_institucion()
{

}

public function delete_institucion()
{
	
}

}