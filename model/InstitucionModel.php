<?php
class InstitucionModel
{

 protected $CRUD;
 protected $tabla='institucion';
 		function __Construct(){
            global $wpdb;
            $this->CRUD=$wpdb;
        }

public function get_institucion($nombre)
{
if(!is_null($nombre))
{
	$filtro="WHERE nombreInstitucion LIKE '".$nombre."%'";
}
else
{
	$filtro="";
}
$resultados=$this->CRUD->get_results("SELECT *, 'Sin Comprobar' AS Estado, 'No Instalado' AS Plugin FROM ".$this->tabla." ".$filtro);
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