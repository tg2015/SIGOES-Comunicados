<?php
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'pdf';
$estado = $_POST['ExportarEstado'];
$cat    = $_POST['ExportarCat'];
$autor  = $_POST['ExportarAutor'];
$nick   = $_POST['ExportarNick'];
$fecha_ini = $_POST['ExportarFechaIni'];
$fecha_fin = $_POST['ExportarFechaFin'];
$extension = '.pdf';
require_once(SIGOES_PLUGIN_DIR.'/controller/ReporteController.php');
$reporteController = new ReporteController();

// Si queremos exportar a PDF
if($tipo == 'pdf'){
    ob_start();
    require_once SIGOES_PLUGIN_DIR.'includes/lib/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Reporte SIGOES');
    $pdf->Output();
    //echo "<script type='text/javascript'>alert('$estado, $cat');</script>";
}     
elseif($tipo=='csv')
{
    // Obtiene consulta para crear archivo csv
    echo "<script type='text/javascript'>alert('$estado, $cat, $autor, $nick, $fecha_ini, $fecha_fin');</script>";     
    $extension='.csv';
    $result = $reporteController->get_sql_result_pantalla($estado,$cat,$autor,$nick,$fecha_ini,$fecha_fin);
    print_r($result);
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysql_num_fields($result);
    $headers = array();
    for ($i = 0; $i < $num_fields; $i++) {
        $headers[] = mysql_field_name($result , $i);
    }
    $fp = fopen('php://output', 'w');
    if ($fp && $result) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="reporte.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
    fputcsv($fp, $headers);
    foreach ($result as $row) 
    {
        fputcsv($fp, array_values($row));
    }
    die;
     $output = stream_get_contents( $fp );
     fclose( $fp );
    }



    /*Codigo Rafa  
    $fp= fopen('php://output', 'w+');
    $columnas = ["Post ID","Titulo","Categoria","Estado","Rol_Autor","Nombre_Autor","Apellido_Autor","Fecha_ini","Fecha_fin"];
        fputcsv($fp, $columnas, ",");
    
    foreach ($result as $valor) 
        { // escribe tabla en archivo csv     
            fputcsv($fp, $valor, ",");
        }
    $output = stream_get_contents( $fp );
    // cerrar archivo
    fclose( $fp );*/

}