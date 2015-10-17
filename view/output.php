<?php
ob_start();
require_once SIGOES_PLUGIN_DIR.'includes/lib/fpdf.php';
class output extends FPDF
{

public function get_elementos($estado_reporte,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin,$array_results,$tipo){
    
    // Si queremos exportar a PDF                           $estado_reporte,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin
    if($tipo == 'pdf'){
    $time = current_time( 'mysql' );
    //if($catego_1){ $categoria = 'Todas las Categorias';}
    //if($estado_reporte){ $estado_reporte = 'Todos los Estados';}
    $columnas = ["Categoria: ".$catego_1,"Estado: ".$estado_reporte,"Rol Autor: ".$autor_1,"Nick: ".$nick_1];

    $contador =0;

    global $current_user;
    get_currentuserinfo();
    $user_name = $current_user->display_name; 
    $user_nick = $current_user->user_nicename;
    $this->SetFont('Arial','B',16);
    //Titulo
    $this->Cell(0,0,'REPORTE SIGOES',0,'R','C');
    $this->Ln(2);
    $this->SetFont('Arial','B',10);
    
    $this->Cell(0,0,utf8_decode('Generado por: '.$user_name),'R',0,'L');
    $this->Cell(0,0,'Fecha de creacion: '.$time,'R',0,'R');
    //$this->Ln(1);
    //$this->Cell(0,0,utf8_decode('Generado por: '.$user_nick),'R',0,'L');
    $this->Ln(1);
    //Primer Encabezado
    $this->SetFillColor(229,229,229);// gris te relleno - celda
    for ($i = 0; $i < 4; $i++) {
        $this->Cell(6.5,1,utf8_decode($columnas[$i]),'1','0','C','1');
    }
    $this->Ln(2);
    //Segundo Encabezado - Tabla
    //(anchocelda,altocelda,texto,borde,posocion sig linea,alineacion,rellenoCelda)
    $this->SetFont('Arial','B',10);
    $this->Cell(1,1,'No','1','0','C','1');
    $this->Cell(4,1,'Titulo','1','0','C','1');
    $this->Cell(2,1,'Categoria','1','0','C','1');
    $this->Cell(2,1,'Estado','1','0','C','1');
    $this->Cell(3.25,1,'Rol Autor','1','0','C','1');
    $this->Cell(2.75,1,'Nick','1','0','C','1');
    $this->Cell(3.05,1,'Nombre','1','0','C','1');
    $this->Cell(4,1,'Fecha Creacion','1','0','C','1');
    $this->Cell(4,1,'Fecha Modificado','1','0','C','1');
    $this->Ln(1);
    $this->SetFont('Arial','',10);
    $this->SetFillColor(255,255,255);
    foreach ($array_results as $fila){
        //$this->CellFitSpace(1,1, utf8_decode($fila['No']),1, 0 , 'L','0' );
        //$this->MultiCell(1,0.8,utf8_decode($fila['ID']),'1','0','C','0');
        $this->Cell(1,1,utf8_decode($fila['ID']),'1','0','C','0');
        $y=$this->GetY();
        $this->MultiCell(4,1,utf8_decode($fila['post_title']),'1','0','C','0');
        $x=$this->GetX();
        $this->SetXY('6',$y);
        $this->Cell(2,1,utf8_decode($fila['post_type']),'1','0','C','0');
        //$y=$this->GetY();
        $this->MultiCell(2,1,utf8_decode($fila['post_status']),'1','0','C','0');
        $this->SetXY('10',$y);
        $this->Cell(3.25,1,utf8_decode($fila['Rol_Autor']),'1','0','C','0');
        $this->Cell(2.75,1,utf8_decode($fila['alias']),'1','0','C','0');
        $this->Cell(3.05,1,utf8_decode($fila['nombre']),'1','0','C','0');
        $this->Cell(4,1,utf8_decode($fila['Fecha_Creacion']),'1','0','C','0');
        $this->Cell(4,1,utf8_decode($fila['Fecha_Modificacion']),'1','0','C','0');
        $this->Ln(1);
        $contador = $contador + 1;
    } 
    $this->Ln(1);
    $this->Cell(4,1,'Total Comunicados: ','1','0','C','0');
    $this->Cell(3,1,$contador,'1','0','C','0');

    require_once(SIGOES_PLUGIN_DIR.'/controller/ReporteController.php');
    $reporteController = new ReporteController();
    $arrayexpo = $reporteController->get_sql_result_csv($estado_reporte,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin);

    }//fin if 
       
    // Si queremos exportar a CSV
    elseif($tipo=='csv'){
    $extension='.csv';
    
    $fp= fopen('php://output', 'w+');
    $columnas = ["Post ID","Titulo","Categoria","Estado","Rol_Autor","Nombre_Autor","Apellido_Autor","Fecha_ini","Fecha_fin"];
    fputcsv($fp, $columnas, ",");
    foreach ($array_results as $valor) { // escribe tabla en archivo csv
    fputcsv($fp, $valor, ",");
    }
    rewind( $fp );    
    $output = stream_get_contents( $fp );
    fclose($fp);
    
    header("Content-type:  text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte".$extension);
    //header('Content-Length: '. strlen($output) );    echo $output;
    
    }//fin elseif
    return; 
    }

}