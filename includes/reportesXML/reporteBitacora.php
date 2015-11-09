<?php
/*
*Nombre del módulo: reporteBitacora.php
*Objetivo: Mostrar las instituciones que se encuentran implementando el plugin-sigoes
*Dirección física: /SIGOES-Comunicados/includes/reportesXML/reporteBitacora.php
*/

include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/tcpdf/tcpdf.php');
include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/PHPJasperXML.inc.php');
include_once(SIGOES_PLUGIN_DIR.'includes/setting.php');

$formato    =$_POST['formato'];
if(isset($_POST['fecha_ini']))
{
    $fecha_ini  =$_POST['fecha_ini'];
    if($fecha_ini!=null)
    {
    $fecha_ini=strtotime($fecha_ini.' 00:00:00');
    $fecha_ini_format=date('Y-m-d H:i:s', $fecha_ini);
    }
}

if(isset($_POST['fecha_fin']))
{
    $fecha_fin  =$_POST['fecha_fin'];
    if($fecha_fin!=null)
    {
    $fecha_fin=strtotime($fecha_fin.' 23:59:59');
    $fecha_fin_format=date('Y-m-d H:i:s', $fecha_fin);
    }
}
    
$user_id    =$_POST['user_id'];
$context    =$_POST['context'];
$action     =$_POST['action'];
$connector  =$_POST['connector'];

//echo $fecha_ini, $fecha_fin, $user_id, $connector, $action;
$usuario=wp_get_current_user();
$nombreCompleto=$usuario->user_firstname." ".$usuario->user_lastname;
ob_end_clean();
ob_start();

$xml = simplexml_load_file(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporteBitacora.jrxml');
if($formato=='pdf')
	{$PHPJasperXML = new PHPJasperXML();}
else
	{$PHPJasperXML = new PHPJasperXML("en","XLS");}

$arrayParametros=["userID" => $user_id, "context"=>$context, "connector"=>$connector, "action"=>$action, "fecha_fin"=>$fecha_fin_format, "fecha_ini"=>$fecha_ini_format];
$PHPJasperXML->SetParametros($arrayParametros);

$PHPJasperXML->debugsql=false;
$PHPJasperXML->xml_dismantle($xml);

$PATH=plugins_url();
ob_end_clean();
ob_start();
/*PARAMETROS PARA ENCABEZADO*/
$PHPJasperXML->arrayParameter=array("PATH"=>$PATH, "idusuario"=>$usuario->user_login, "nombreusuario" =>$nombreCompleto);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
if($formato=='pdf')
	{$PHPJasperXML->outpage("I");}
else
	{$PHPJasperXML->outpage("I","Bitacora.xls");}
?>