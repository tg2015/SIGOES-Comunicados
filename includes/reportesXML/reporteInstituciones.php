<?php
/*
*Nombre del módulo: reporteInstituciones.php
*Objetivo: Mostrar las instituciones que se encuentran implementando el plugin-sigoes
*Dirección física: /SIGOES-Comunicados/includes/reportesXML/reporteInstituciones.php
*/

include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/tcpdf/tcpdf.php');
include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/PHPJasperXML.inc.php');
include_once(SIGOES_PLUGIN_DIR.'includes/setting.php');

$formato    =$_POST['formato'];
$tipoReporte=$_POST['tipoReporte'];
switch ($tipoReporte) {
    case 'inaccesible':
        $reporte='reporteSitiosWeb.jrxml';
        break;
    case 'parametros':
        $reporte='reporteParametros.jrxml';
        break;
    case 'instituciones':
        $reporte='reporteInstituciones.jrxml';
        break;
}

$usuario=wp_get_current_user();
$nombreCompleto=$usuario->user_firstname." ".$usuario->user_lastname;
ob_end_clean();
ob_start();

$xml = simplexml_load_file(SIGOES_PLUGIN_DIR.'includes/reportesXML/'.$reporte.'');
if($formato=='pdf')
	{$PHPJasperXML = new PHPJasperXML();}
else
	{$PHPJasperXML = new PHPJasperXML("en","XLS");}

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
	{$PHPJasperXML->outpage("I","Instituciones.xls");}
?>