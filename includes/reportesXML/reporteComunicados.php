<?php
/*
*Nombre del módulo: reporteComunicados.php
*Objetivo: Mostrar los Comunicados Publicados
*Dirección física: /SIGOES-Comunicados/includes/reportesXML/reporteComunicados.php
*/

include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/tcpdf/tcpdf.php');
include_once(SIGOES_PLUGIN_DIR.'includes/lib/phpjasperxml/class/PHPJasperXML.inc.php');
include_once(SIGOES_PLUGIN_DIR.'includes/setting.php');

ob_end_clean();
ob_start();
$estado		=$_POST['estado'];
$cat		=$_POST['cat'];
$nick		=$_POST['nick'];
$autor		=$_POST['autor'];
$fecha_ini	=$_POST['fecha_ini'];
$fecha_fin	=$_POST['fecha_fin'];

$usuario=wp_get_current_user();
$nombreCompleto=$usuario->user_firstname." ".$usuario->user_lastname;
$xml = simplexml_load_file(SIGOES_PLUGIN_DIR.'includes/reportesXML/reporteComunicados.jrxml');
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=false;
$PHPJasperXML->xml_dismantle($xml);
$PATH=plugins_url();
$PHPJasperXML->arrayParameter=array("PATH"=>$PATH, "idusuario"=>$usuario->user_login, "nombreusuario" =>$nombreCompleto);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");
?>