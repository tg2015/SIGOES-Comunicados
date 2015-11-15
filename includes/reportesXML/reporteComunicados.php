<?php
/*
*Nombre del módulo: reporteComunicados.php
*Objetivo: Mostrar los Comunicados Publicados
*Dirección física: /SIGOES-Comunicados/includes/reportesXML/reporteComunicados.php
*/

include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/tcpdf/tcpdf.php');
include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/PHPJasperXML.inc.php');
include_once(SIGOES_PLUGIN_DIR.'includes/setting.php');

$estado		=$_POST["ExportarEstado"];
$cat		=$_POST['ExportarCat'];
$autor		=$_POST['ExportarAutor'];
$fecha_ini	=$_POST['ExportarFechaIni'];
$fecha_fin	=$_POST['ExportarFechaFin'];
$formato    =$_POST['formato'];


if( $fecha_ini == NULL && $fecha_fin == NULL){
    $filtro_fecha = " ";
}else{ if( $fecha_ini=="%" && $fecha_fin=="%" ) {
       $filtro_fecha = " ";
    }
    else
    { 
    $fecha_ini=strtotime($fecha_ini.' 00:00:00');
    $fecha_fin=strtotime($fecha_fin.' 23:59:59');
    $fecha_ini_format=date('Y-m-d H:i:s', $fecha_ini);
    $fecha_fin_format=date('Y-m-d H:i:s', $fecha_fin);
    if($fecha_fin_format>$fecha_ini_format)
        {$filtro_fecha=" AND post_date between '".$fecha_ini_format."' and '".$fecha_fin_format."'";}
    }
}

$usuario=wp_get_current_user();
$nombreCompleto=$usuario->user_firstname." ".$usuario->user_lastname;
ob_end_clean();
ob_start();
$xml = simplexml_load_file(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporteComunicados.jrxml');
if($formato=='pdf')
{$PHPJasperXML = new PHPJasperXML();}
else 
{$PHPJasperXML = new PHPJasperXML("en","XLS");}
$PHPJasperXML->SetPrefijo($pfrpt);

/*PARAMETROS PARA SQL*/
$autorPost='%'.$autor.'%';
$arrayParametros=["estado" => $estado, "cat"=>$cat, "autor"=>$autorPost, "fecha_ini"=>$fecha_ini_format, "fecha_fin"=>$fecha_fin_format];
$PHPJasperXML->SetParametros($arrayParametros);

$PHPJasperXML->debugsql=false;
$PHPJasperXML->xml_dismantle($xml);
$PATH=plugins_url();
ob_end_clean();
ob_start();
/*PARAMETROS PARA ENCABEZADO*/
switch ($estado) {
case 'publish':
    $estado ='Publicado';
break;
case 'pending':
    $estado ='Pendiente de Revision'; 
break;
case 'draft':
    $estado ='Borrador'; 
break;
case 'Cancelado':
    $estado ='Cancelado'; 
break;
case '%':
    $estado='Todos';
break;
} 

if($cat=='%')
{$cat='Todos';}
if($autor=='%')
{$autor='Todos';}
$PHPJasperXML->arrayParameter=array("PATH"=>$PATH, "idusuario"=>$usuario->user_login, "nombreusuario"=>$nombreCompleto, "estado"=>$estado, "autor"=>$autor, "cat"=>$cat, "filtro_fecha"=>$filtro_fecha);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
if($formato=='pdf')
{$PHPJasperXML->outpage("I");}
else
{$PHPJasperXML->outpage("I","Comunicados.xls");}
?>