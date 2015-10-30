<?php
ob_start();
require_once SIGOES_PLUGIN_DIR.'includes/lib/fpdf.php';
class output extends FPDF
{

public function set_estado($estado){
    if($estado=='Pendiente de revision'){
        return 'Pendiente';
    }else{
        return $estado; 
    }
}    
// Pie de página
public function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(20);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(26,1,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');
}

public function CrearPDF($estado_reporte,$catego_1,$autor_1,$nick_1,$fecha_ini,$fecha_fin,$array_results){
    
// Autor
    $this->SetAuthor('Rafael R.',true);
    $this->SetCreator('SIGOES', true);    
// Titulo
    $this->SetTitle('Reporte de Comunicados', true); 
    $this->SetSubject('Comunicados', true);
    
// fecha y hora del sistema
    $time = current_time( 'mysql' );
    // Variables utilizadas para definir ancho de las columnas
    $catCell=2; $estadoCell=2; $rolCell=3.25; $nickCell=2.75; $TCell=4; $W = 0;
    $AltoPag = 18;
    // Condiciones para validar primer encabezado
    if($estado_reporte=='%'){   $estado = 'Todos los estados'; 
                                $estado_print = 'no';
                                
    }else{ 
    $estado_print  = 'si'; $W=$W+$estadoCell;
    switch ($estado_reporte) {
                     case 'publish':
                         $estado ='Publicado'; 
                         break;
                     case 'pending':
                         $estado ='Pendiente de revision'; 
                         break;
                     case 'draft':
                         $estado ='Borrador'; 
                         break;
                     case 'Cancelado':
                         $estado ='Cancelado'; 
                         break;
                     default:
                         $estado = $estado_reporte;
                         break;
                 }
    }                 
    if($catego_1=='%'){$cat = 'Todas las categorias'; $cat_print = 'no'; }   else{ $cat = $catego_1; $cat_print = 'si';$W=$W+$catCell;}
    if($autor_1=='%'){$rol = 'Todos los roles'; $rol_print = 'no'; }         else{ $rol = $autor_1; $rol_print = 'si';$W=$W+$rolCell;}
    if($nick_1=='%'){$nick = 'Todos los usuarios'; $nick_print = 'no'; }     else{ $nick = $nick_1; $nick_print = 'si';$W=$W+$nickCell;}


    $columnas = ["Categoria: ".$cat,"Estado: ".$estado,"Rol Autor: ".$rol,"Nick: ".$nick];
    $contador =0;

    global $current_user;
    get_currentuserinfo();
    $user_name = $current_user->display_name; 
    $user_nick = $current_user->user_nicename;
    $this->SetFont('Arial','B',16);
    //Titulo
    $this->Image(SIGOES_PLUGIN_DIR.'includes/img/LogoGob.jpeg','01','0.5','5','2');
    $this->Cell(0,0,'REPORTE DE COMUNICADOS',0,'R','C');
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
    // Define altura de tupla $y define ancho de cada columna $x
    $yEncabezado=$this->GetY();
    $x1=$this->GetX();
    $this->Cell(1,1,'No','1','0','C','1');
    $x2=$this->GetX();
    $this->Cell($TCell+$W,1,'Titulo','1','0','C','1');
    $x3=$this->GetX();
    $this->SetXY($x3,$yEncabezado);  // calcula ancho del titulo segun las columnas que no salen

    //condicion de filas que deben verse en tabla
    if($cat_print!='si'){ $this->Cell(2,1,'Categoria','1','0','C','1'); $x4=$this->GetX();}
    if($estado_print!='si'){ $this->Cell(2,1,'Estado','1','0','C','1'); $x5=$this->GetX();}
    if($rol_print!='si'){ $this->Cell(3.25,1,'Rol Autor','1','0','C','1');$x6=$this->GetX();}
    if($nick_print!='si'){ $this->Cell(2.75,1,'Nick','1','0','C','1');$x7=$this->GetX();}
    
    $this->Cell(3.05,1,'Nombre','1','0','C','1');
    $x8=$this->GetX();
    $this->Cell(4,1,'Fecha Creacion','1','0','C','1');
    $x9=$this->GetX();
    $this->Cell(4,1,'Fecha Modificado','1','0','C','1');
    $x10=$this->GetX();
    $this->Ln(1);
    $this->SetFont('Arial','',10);
    $this->SetFillColor(255,255,255);
    $Nfila = 0;
    
    foreach ($array_results as $fila){

        $salto='no';
        //$this->SetAutoPageBreak(false,2);    // deshabilita salto de pagina automatico
        $yTupla=$this->GetY();
        if($yTupla+$Nfila>18){  $this->SetAutoPageBreak(true,2);} // habilita salto de pagina cuando se pasa del margen
        
        if($yTupla>18){$this->SetAutoPageBreak(true,3);}
        $this->SetXY($x1,$yTupla+$Nfila);
        //$this->Cell(1,1,utf8_decode($fila['ID']),'LTR','0','C','0');
        $this->Cell(1,1,$contador+1,'LTR','0','C','0');
        $yTupla=$this->GetY(); 
        $Nfila = 0;
        $this->MultiCell($TCell+$W,1,utf8_decode($fila['post_title']),'LTR','0','C','0');
        $AltoTitulo=$this->GetY(); // calculo de alto de celda del titulo
        $AltoTitulo = $AltoTitulo - $yTupla;
        
        if($AltoTitulo>1){$Nfila = $Nfila + $AltoTitulo - 1;
        }else{$Nfila =0; //if($AltoTitulo<0){$this->SetAutoPageBreak(false,2);}
        }

        $this->SetXY($x3,$yTupla);// calcula ancho del titulo segun las columnas que no salen

        $this->line($x1,$yTupla+$AltoTitulo,$x10,$yTupla+$AltoTitulo); // linea horizontal inferior
        $this->line($x1,$yTupla,$x1,$yTupla+$AltoTitulo); // Linea vertical x1
        $this->line($x2,$yTupla,$x2,$yTupla+$AltoTitulo); // Linea vertical x2
        $this->line($x3,$yTupla,$x3,$yTupla+$AltoTitulo); // Linea vertical x3
        if($cat_print!='si'){ 
        $this->line($x4,$yTupla,$x4,$yTupla+$AltoTitulo);}// Linea vertical x4  
        if($estado_print!='si'){
        $this->line($x5,$yTupla,$x5,$yTupla+$AltoTitulo);}// Linea vertical x5  
        if($rol_print!='si'){
        $this->line($x6,$yTupla,$x6,$yTupla+$AltoTitulo);}// Linea vertical x6   
        $this->line($x7,$yTupla,$x7,$yTupla+$AltoTitulo); // Linea vertical x7  
        $this->line($x8,$yTupla,$x8,$yTupla+$AltoTitulo); // Linea vertical x8  
        $this->line($x9,$yTupla,$x9,$yTupla+$AltoTitulo); // Linea vertical x9  
        $this->line($x10,$yTupla,$x10,$yTupla+$AltoTitulo); 
        
        //if($AltoTitulo<0){$this->SetAutoPageBreak(false,2);}
        if($cat_print!='si'){  //condicion para poner en pantalla si se aplica filtro
        $this->Cell(2,1,utf8_decode($fila['post_type']),'LTR','0','C','0'); 
        }
        if($estado_print!='si'){ //$y=$this->GetY(); 
        //
        $this->Cell(2,1,utf8_decode($this->set_estado($fila['post_status'])),'LTR','0','C','0');
        }
        //$this->SetXY('10',$y);
        if($rol_print!='si'){ //$this->SetXY('10',$y);
        $this->Cell(3.25,1,utf8_decode($fila['Rol_Autor']),'LTR','0','C','0');
        }
        if($nick_print!='si'){ $this->Cell(2.75,1,utf8_decode($fila['alias']),'LTR','0','C','0');}
        $this->Cell(3.05,1,utf8_decode($fila['nombre']),'LTR','0','C','0');
        $this->Cell(4,1,utf8_decode($fila['Fecha_Creacion']),'LTR','0','C','0');
        $this->Cell(4,1,utf8_decode($fila['Fecha_Modificacion']),'LTR','0','C','0');
        //$this->Cell(4,1,$AltoTitulo.' '.$yTupla.' '.$Nfila,'LTR','0','C','0');
        $yUlt=$this->GetY();
        if($yTupla>17){$this->SetAutoPageBreak(true,2);}
        $this->Ln(1);

        $contador = $contador + 1;
        

    }//fin foreach 

    //$this->Ln(1);
    $this->SetXY($x1, $yUlt+$AltoTitulo);
    $this->Ln(1);
    $this->SetFont('Arial','B',10);
    $this->SetFillColor(229,229,229);// gris relleno - celda
    $this->Cell(4,1,'Total Comunicados: ','1','0','C','1');
    $this->Cell(3,1,$contador,'1','0','C','1');

//ob_clean();
}
public function CrearCSV($array_results){
ob_start();
//ob_end_clean();

//ob_start();
//header('Content-Description: File Transfer');
//header('Content-Type: application/octet-stream');
header('content-type:application/csv;charset=UTF-8');
header('Content-Disposition: attachment; filename=Reporte_SIGOES.csv');
//header('Content-Transfer-Encoding: binary');
//header('Expires: 0');
//header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//header('Pragma: public');
//echo "\xEF\xBB\xBF"; // UTF-8 BOM
    /*
    header('Content-Encoding: UTF-8');
    header("content-type:application/csv;charset=UTF-8");
    header("Content-Disposition:attachment;filename=\"Reporte_SIGOES.csv\"");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
    */
    //$fp= fopen('php://output', 'w');
    //ob_clean();
    $fp = fopen('php://output', 'w+');
    $columnas = ['No','Titulo',"Categoria","Estado","Rol_Autor","Nombre_Autor","Apellido_Autor","Fecha_ini","Fecha_fin"];
    fputcsv($fp, $columnas, ',');
    foreach ($array_results as $valor) { // escribe tabla en archivo csv
    fputcsv($fp, $valor, ',');
    }
    rewind( $fp );    
    //$output = stream_get_contents( $fp );
    fclose($fp);
    echo $output;
    
    }// fin CrearCSV

    
// orden descendente en consulta 
// guion en la fecha hora
// csv
    

}