<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Print extends Controller {
    public function action_hr()
    {      
      $auth=  Auth::instance();
      if($auth->logged_in()&&isset($_GET['codigo']))
    {
    $hr=$_GET['codigo'];
    require Kohana::find_file('vendor/fpdf17', 'fpdf');
    require Kohana::find_file('vendor/fpdf17', 'code39');  
    $modelo=New Model_Hojasruta();
    $hojaruta=$modelo->imprimir($hr);
    //
    foreach($hojaruta as $rs)
    {
    $pdf = new PDF_Code39('P','mm','Letter');
    $pdf->SetMargins(10, 10,5);
    $pdf->AddPage();    
    $pdf->SetFont('Arial', 'B', 18);    
    $image_file = 'media/logos/'.$rs->logo;
    $pdf->Image($image_file, 12, 10, 55, 30, 'png', '', '', FALSE, 300, '', FALSE, FALSE, 1);
    $pdf->SetFont('Arial', '', 20);
    $pdf->SetX(10);
    $pdf->Cell(60, 30, '', 1,FALSE,'C');                               
    $pdf->SetX(70);
    //hoja de seguimiento
    $pdf->Cell(75, 30, 'HOJA DE RUTA', 1,FALSE,'C');                                                                 
    $pdf->SetX(145);    
    //NUA
    $pdf->SetFont('Arial', 'B', 10);    
    $pdf->Cell(65, 5, $rs->sigla, 1,FALSE,'C');
    $pdf->SetXY(145, 15);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(65, 5, $rs->nur, 'TR',FALSE,'C');
    
    $pdf->SetXY(70, 20);  
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(75, 20, utf8_decode('Ministerio de Desarrollo Productivo y Economía Plural'), 0,FALSE,'C'); 
    $pdf->SetFont('Arial', 'B', 14);    
    //$pdf->Cell(57, 5, $rs->nur, 'TR',FALSE,'C');
    $pdf->SetXY(145, 15);    
    //codigo de barra    
    if(strpos($rs->nur, "/"))    
        $pdf->Code39(147,20,$rs->nur,0.71,12);    
        //$pdf->Code39(152,21,$rs->nur,0.71,8);    
    else
        $pdf->Code39(155,20,$rs->nur,0.71,12);
        //$pdf->Code39(155,21,$rs->nur,0.71,8);
    //fin codigo barra
    $pdf->SetXY(145, 20);
    $pdf->Cell(65, 15, '', 'BR',FALSE,'C');    
    
    //cite
    $pdf->SetXY(145, 35);    
    $pdf->Cell(65, 5, utf8_decode($rs->cite_original), 1,FALSE,'C');
    $pdf->Ln();
    //columna 1
    $pdf->SetFont('helvetica', '', 9);    
    $pdf->Cell(30, 10, 'PROCEDENCIA:', 1,FALSE,'L');
    
        
    if(trim($rs->institucion_remitente)!='')
    {
        if(strlen($rs->institucion_remitente)>100)
        {
            $pdf->MultiCell(115, 10, utf8_decode($rs->institucion_remitente), 1,'L'); 
        }
        else
        {
            $pdf->Cell(115, 10, utf8_decode($rs->institucion_remitente), 1,'L'); 
        }
    }
    else
    {
        if(strlen($rs->entidad)>80)
        {
            $pdf->MultiCell(115, 5, utf8_decode($rs->entidad), 1,'L'); 
        }
        else
        {
            $pdf->Cell(115, 10, utf8_decode($rs->entidad), 1,'L'); 
        }         
    }    
    //fecha
    $pdf->SetXY(155, 40);   
    $pdf->Cell(13, 5, 'FECHA:', 1,FALSE,'R'); 
    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
    $mes=(int)date('m', $rs->fecha_creacion);
    $dia=date('d', $rs->fecha_creacion);
    $anio=date('Y',  $rs->fecha_creacion);
    $fecha=$dia.' de '.$meses[$mes].' de '.$anio;
    $pdf->Cell(42, 5, $fecha, 1,FALSE,'C');     
    //hora
    $pdf->SetXY(155, 45);   
    $pdf->Cell(13, 5, 'HORA:', 1,FALSE,'R');    
    $pdf->Cell(42, 5, date('h:i:s A',$rs->fecha_creacion), 1,FALSE,'C');   
    //REMITENTE
    $pdf->SetXY(10, 50);
    $pdf->Cell(30, 10, 'REMITENTE:', 1,FALSE,'L');    
    $pdf->Cell(105, 6, utf8_decode($rs->nombre_remitente), 0,FALSE,'L');

    $pdf->SetFont('helvetica', 'B', 9);   
    $pdf->SetXY(40, 55);
    $pdf->Cell(105, 3, utf8_decode($rs->cargo_remitente), 0,FALSE,'L');
    $pdf->SetFont('helvetica', '', 9);    
    //proceso
    //fecha
    $pdf->SetXY(155, 50);   
    $pdf->SetFontSize(7);
    $pdf->Cell(13, 10, 'PROCESO', 1,FALSE,'R');     
    $pdf->MultiCell(42, 10, utf8_decode($rs->proceso), 1,'C');        
    $pdf->SetXY(10, 60);
    $pdf->SetFontSize(9);
    $pdf->Cell(30, 10, 'REFERENCIA:', 1,FALSE,'L');    
    $pdf->SetFont('helvetica', '', 9);             
    if(strlen($rs->institucion_remitente)>120)
    {
       $pdf->MultiCell(170, 5, utf8_decode($rs->referencia), 1,'L'); 
    }
    else
    {
       $pdf->Cell(170, 10, utf8_decode($rs->referencia), 1,'L'); 
    }              
    $pdf->Ln(10);    
    $pdf->Cell(30, 5, 'ADJUNTO:', 1,FALSE,'L');    
    $pdf->Cell(145, 5, $rs->adjuntos, 'BLR',FALSE,'L');
    $pdf->Cell(15, 5, 'HOJAS', 'BLR',FALSE,'L');
    $pdf->Cell(10, 5, $rs->hojas, 'BLR',FALSE,'C');
    $pdf->Ln();
    //primera pagina
    for($i=1;$i<4;$i++)
    {
        $pdf->Ln(4);
    $pdf->SetFontSize(10);
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(20, 7, 'Para:', 1,FALSE,'L',true);    
    $pdf->SetFillColor(0);
    $pdf->Cell(60, 7, '', 1,FALSE,'L');    
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(10, 7, 'CC:', 1,FALSE,'L',true);
    $pdf->SetFillColor(0);
    $pdf->Cell(110, 7, '', 1,FALSE,'C');
    $pdf->ln();
    $pdf->SetFontSize(4);
    $pdf->Cell(26, 5, 'ACCION NECESARIA Y RESPUESTA', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');    
    $pdf->Cell(24, 5, 'PREPARAR RESPUESTA', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'PREPARAR INFORME', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(26, 5, 'PARA SU CONOCIMIENTO', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'PARA FIRMA', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'DESPACHAR', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'ARCHIVAR', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Ln();
    //proveido
    $pdf->Cell(144, 40, '', 1,FALSE,'L');
    $pdf->SetTextColor(243,249,255);
     $pdf->SetFontSize(20);
    $pdf->Cell(56, 40, 'Sello Recibido', 1,FALSE,'C');
    $pdf->SetTextColor(0);
    $pdf->Ln(40);
    $pdf->SetFillColor(240,245,255);
    
    $pdf->SetFontSize(10);
    $pdf->Cell(20, 5, 'Adjunto:', 1,FALSE,'L',true);
    $pdf->Cell(124, 5, '', 1,FALSE,'L');
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(20, 5, 'Hora:', 1,FALSE,'L',true);
    $pdf->Cell(36, 5, '', 1,FALSE,'L');
    $pdf->Ln();
    }
    $pdf->Cell(20, 5,'Hoja de Ruta: '. $rs->nur, 0,FALSE,'L');    
    $pdf->ln();
    //segunda APgina
    for($i=1;$i<5;$i++)
    {
    $pdf->Ln(4);
    $pdf->SetFontSize(10);
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(20, 7, 'Para:', 1,FALSE,'L',true);    
    $pdf->SetFillColor(0);
    $pdf->Cell(60, 7, '', 1,FALSE,'L');    
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(10, 7, 'CC:', 1,FALSE,'L',true);
    $pdf->SetFillColor(0);
    $pdf->Cell(110, 7, '', 1,FALSE,'C');
    $pdf->ln();
    $pdf->SetFontSize(4);
    $pdf->Cell(26, 5, 'ACCION NECESARIA Y RESPUESTA', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');    
    $pdf->Cell(24, 5, 'PREPARAR RESPUESTA', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'PREPARAR INFORME', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(26, 5, 'PARA SU CONOCIMIENTO', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'PARA FIRMA', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'DESPACHAR', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Cell(24, 5, 'ARCHIVAR', 1,FALSE,'L');
    $pdf->Cell(4, 5, '', 1,FALSE,'L');
    $pdf->Ln();
    //proveido
    $pdf->Cell(144, 40, '', 1,FALSE,'L');
    $pdf->SetTextColor(243,249,255);
     $pdf->SetFontSize(20);
    $pdf->Cell(56, 40, 'Sello Recibido', 1,FALSE,'C');
    $pdf->SetTextColor(0);
    $pdf->Ln(40);
    $pdf->SetFillColor(240,245,255);
    
    $pdf->SetFontSize(10);
    $pdf->Cell(20, 5, 'Adjunto:', 1,FALSE,'L',true);
    $pdf->Cell(124, 5, '', 1,FALSE,'L');
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(20, 5, 'Hora:', 1,FALSE,'L',true);
    $pdf->Cell(36, 5, '', 1,FALSE,'L');
    $pdf->Ln();
    }
    $pdf->Output('hoja_ruta.pdf','D');
    }
    
    }
    
  }
}