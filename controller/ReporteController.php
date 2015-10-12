<?php
//require_once(SIGOES_PLUGIN_DIR.'/class/Comunicado.php');
class ReporteController
{

///////////   CONSULTAS PARA OBTENER ITEMS DEL SELECT
public function get_sql_post_status()
{

        require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $model_consulta = new ReporteModel();
             // Consultas para llenar las opciones del select
            $estados_array = $model_consulta->get_post_status(); 
    return ($estados_array);
}            
public function get_sql_post_type()
{

        require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $model_consulta = new ReporteModel();
            $categorias_array = $model_consulta->get_post_type(); 
            $rol_array =  $model_consulta->get_rol_user(); 

    return ($categorias_array);
}
public function get_sql_rol_user()
{

        require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $model_consulta = new ReporteModel();
            $rol_array =  $model_consulta->get_rol_user(); 

    return ($rol_array);
}
public function get_sql_nickname_user()
{

        require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $model_consulta = new ReporteModel();
            $nick_array =  $model_consulta->get_nickname_user(); 

    return $nick_array;
}
////////////////// CONSULTAS PARA OBTENER REPORTE PANTALLA - ARCHIVO CSV
public function get_sql_result_pantalla($estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin)
{

        require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $model_consulta = new ReporteModel();
            $sql_result =  $model_consulta->get_reporte($estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin); 

    return ($sql_result);
}

public function get_sql_result_csv($estado_,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin)
{

        require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $model_consulta = new ReporteModel();
            $array_results =  $model_consulta->get_reporte_csv($estado_, $catego_1, $autor_1, $nick_1,$fecha_ini,$fecha_fin); 

    return $array_results;
}


/////////////////////////////////////////////////////
public function crear_archivo_csv($output,$array_results)
    {


    header("Content-type: application/csv charset=utf-8");

    header("Content-Disposition: attachment; filename=Fichero-". time() .".csv");

  
    header('Content-Length: '. strlen($output) );
    echo $output;

    }

    public function Listar($estado, $cat, $autor,$nick,$fecha_ini,$fecha_fin)
    {
            
            require_once(SIGOES_PLUGIN_DIR.'/model/ReporteModel.php');
            $consulta = new ReporteModel();
            $sql_result =  $consulta->get_reporte($estado, $cat, $autor,$nick,$fecha_ini,$fecha_fin); 
    }

}
?>    