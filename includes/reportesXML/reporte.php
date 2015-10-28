<?php
/*
*Estructura de Reporte Instituciones
*/

include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/tcpdf/tcpdf.php');
include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/PHPJasperXML.inc.php');
include_once(SIGOES_PLUGIN_DIR.'includes/setting.php');

ob_end_clean();
ob_start();
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
$xml = simplexml_load_file(SIGOES_PLUGIN_DIR.'includes/reportesXML/'.$reporte.'');
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML = new PHPJasperXML("en","XLS");
$PHPJasperXML->debugsql=false;
$PHPJasperXML->xml_dismantle($xml);
//$nombre=$_GET['nombre'];
$PATH=plugins_url();
$PHPJasperXML->arrayParameter=array("PATH"=>$PATH, "idusuario"=>$usuario->user_login, "nombreusuario" =>$nombreCompleto);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");
//$PHPJasperXML->outpage("I","sample9.xls");

?>