<?php

require(SIGOES_PLUGIN_DIR.'/pdf/fpdf.php');

class Reporte_PDF extends FPDF
{
	

	public function get_elementos($estado_,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin,$sql_results){

		

	return; 
	}

}
	// Cabecera de página
	//global $current_user;
	$time = current_time( 'mysql' );

	 global $current_user;
    get_currentuserinfo();

    $user = $current_user->display_name; 

    // FPDF( {'P' normal || 'L' horizontal}, {'mm' milimetro}, {'L' letter})
    
	$pdf = new FPDF('L','cm','Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    // Movernos a la derecha
    //$pdf->Cell(80);
    // Título
    //$pdf->Cell(30,10,'REPORTE SIGOES',0,0,'C');
    // Salto de línea
    //$pdf1->Cell(40,10,utf8_decode('Fecha: '.$time),'R',0,'R');

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "2009 Widget Sales Report";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 9940, 10100, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

// End configuration


$pdf->SetFont( 'Arial', 'B', 16 );
 // Título
    $pdf->Cell( 0, 0, 'REPORTE SIGOES', 0, 0, 'C' );
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,0,utf8_decode('Generado por: '.$user),'R',0,'L');
//    $pdf->Ln(1);
    $pdf->Cell(0,0,'Fecha de creacion: '.$time,'R',0,'R');
    $pdf->Ln(1);



    

$pdf->Output(SIGOES_PLUGIN_DIR.'controller/Reportes/Reporte_SIGOES '.$time, 'F');


?>