<?php
require_once('libs/tcpdf/config/lang/eng.php');
require_once('libs/tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	/*public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'logo.jpg';
                $this->Image($image_file, 3, 2, 35, 0, 'JPG', '', '', FALSE, 300, '', FALSE, FALSE, 1);
		//$this->Image($image_file, 3, 2, 30, '', 'JPG');
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
                $this->Ln();
		$this->Cell(0, 30, '', 'B', false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
/*	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 7);
		// Page number
		//$this->Cell(0, 10, 'Av. Mariscal Santa Cruz, Edif. Palacio de Comunicaciones Piso 20 - Telefono(2124935-40)-2124933'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 10, 'Av. Mariscal Santa Cruz, Edif. Palacio de Comunicaciones Piso 20 - Telefono(2124935-40)-2124933, Fax: 212913 - Casilla 1868', 'T', false, 'C', 0, '', 0, false, 'T', 'M');
                $this->Ln(2);
		$this->Cell(0, 15, 'La Paz - Bolivia', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}*/
}

// create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
    $pdf->SetFont('Helvetica', 'B', 18);
    $pdf->AddPage();
    $image_file = K_PATH_IMAGES.'logo.jpg';
    $pdf->Image($image_file, 10, 10, 35, 20, 'JPG', '', '', FALSE, 300, '', FALSE, FALSE, 1);
    $pdf->SetFont('helvetica', '', 18);
    $pdf->SetX(45);
    //hoja de seguimiento
    $pdf->Cell(107, 20, 'HOJA DE SEGUIMIENTO INTERNO', 1,FALSE,'C');                               
    $pdf->SetX(152);
    //logo entidad
    $pdf->
    //
    $pdf->SetFont('helvetica', 'B', 10);    
    $pdf->Cell(55, 5, 'NURI', 1,FALSE,'C');
    $pdf->SetXY(152, 15);
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(55, 5, 'I/2011-02560', 'TR',FALSE,'C');
    $pdf->SetXY(152, 15);    
    //codigo de barra
    $pdf->write1DBarcode('I/2011-02560', 'C39', 154, 21, 51, 8, .8, array('align'=>'C'), 'N');
    $pdf->SetXY(152, 15);
    $pdf->Cell(55, 15, '', 'BR',FALSE,'C');    
    $pdf->Ln();

    //columna 1
    $pdf->SetFont('helvetica', 'B', 10);    
    $pdf->Cell(35, 10, 'Entidad', 1,FALSE,'L');
    $pdf->SetFont('helvetica', '', 9);    
    $pdf->Cell(107, 10, 'MINISTERIO DE DESARROLLO PRODUCTIVO Y ECONOMIA PLURAL', 1,FALSE,'L');
    $pdf->Cell(55, 5, 'CITE', 1,FALSE,'C');
    $pdf->SetXY(152, 35);    
    $pdf->Cell(55, 5, 'INF/MDP/DGA/US/SIS/2011-0015', 1,FALSE,'C');
    $pdf->Ln();
    //REMITENTE
    $pdf->Cell(35, 10, 'Remitente', 1,FALSE,'L');    
    $pdf->Cell(107, 5, 'Nombre Remitente', 'TLR',FALSE,'L');
    $pdf->SetFont('helvetica', 'B', 9);   
    $pdf->SetXY(45, 45);
    $pdf->Cell(107, 5, 'Cargo Remitente', 'BLR',FALSE,'L');
    $pdf->SetFont('helvetica', '', 9);    
    
    $pdf->Ln();
    $pdf->Cell(35, 10, 'Referencia', 1,FALSE,'L');    
    $pdf->SetFont('helvetica', '', 9);   
    $pdf->MultiCell(162, 10, 'Refeencia con texto mayodeaskjdaskljdlmas asd as d as dasdasd  as da sd', 1, 'L');
    //fecha
    $pdf->SetXY(152, 40);   
    $pdf->Cell(15, 5, 'Fecha', 1,FALSE,'R');    
    $pdf->Cell(40, 5, '15 de Diciembre de 2010', 1,FALSE,'R');     
    //hora
    $pdf->SetXY(152, 45);   
    $pdf->Cell(15, 5, 'Hora', 1,FALSE,'R');    
    $pdf->Cell(40, 5, '15:00:00 PM', 1,FALSE,'R');     
    $pdf->Ln(15);    
    $pdf->Cell(35, 5, 'Adjunto', 1,FALSE,'L');    
    $pdf->Cell(107, 5, 'DOCUMENTO', 'BLR',FALSE,'L');
    $pdf->Cell(15, 5, 'N° Hojas', 'BLR',FALSE,'L');
    $pdf->Cell(40, 5, '', 'BLR',FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(35, 5, 'Accion', 1,FALSE,'L');        
    //sello de despacho
    //$pdf->SetXY(152, 15);
    $pdf->Cell(60, 40, 'Sello de despacho', 1,FALSE,'C');
    $pdf->Cell(90, 40, 'Proceso', 1,FALSE,'C');
    
    $pdf->SetXY(10, 40);
    $pdf->SetFont('helvetica', '', 6);    
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Accion Necesaria y Respuesta', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Preparar Respuesta', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Preparar Informe', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Hacer Seguimiento', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Para su conocimiento', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Para firma', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Despachar', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    $pdf->Ln();
    $pdf->Cell(30, 5    , 'Archivar', 1,FALSE,'L');
    $pdf->Cell(5, 5    , '', 1,FALSE,'L');
    
    //columna 2
    $pdf->SetXY(45, 30);
    $pdf->SetFont('helvetica', '', 9);    
  //  $pdf->Cell(107, 10, 'MINISTERIO DE DESARROLLO PRODUCTIVO Y ECONOMIA PLURAL', 1,FALSE,'L');
    $pdf->SetXY(45, 40);
    $pdf->SetXY(45, 50);
    
    $pdf->SetXY(45, 60);
    
    
    
		//$this->Image($image_file, 3, 2, 30, '', 'JPG');
		// Set font
		
		// Title
                $pdf->Ln();
		$pdf->Cell(0, 30, '', 'B', false, 'C', 0, '', 0, false, 'M', 'M');
/*
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);
*/


// add a page


try {
        $id=$_GET['id'];
        $dbh = new PDO('mysql:host=localhost;port=3306;dbname=paperwork', 'root', '', array( PDO::ATTR_PERSISTENT => false));
        $stmt = $dbh->prepare("SELECT * FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id
                               WHERE d.id='$id'");
        // call the stored procedure
        $stmt->execute();        
        //echo "<B>outputting...</B><BR>";
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            /*$pdf->SetFont('Helvetica', 'B', 16);
            $pdf->Cell(20,15, 'HOJA DE SEGUIMIENTO INTERNO','',0,'C');
            $pdf->Ln();
            $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->Write(0, strtoupper($rs->codigo),'',0,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Cell(15, 5, 'A:'); 
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Write(0, $rs->nombreDestinatario,'',0,'L');
            $pdf->Ln();            
            $pdf->Cell(15, 5, ''); 
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Write(0, $rs->cargoDestinatario,'',0,'L');
            $pdf->Ln(10);
            if(($rs->via!=0)&&(trim($rs->nombreVia)!='')){
                $pdf->SetFont('Helvetica', 'B', 11);
                $pdf->Cell(15, 5, 'Via:');
                $pdf->SetFont('Helvetica', '', 11);
                $pdf->Write(0, $rs->nombreVia,'',0,'L');
                $pdf->Ln();                
                $pdf->Cell(15, 5, '');
                $pdf->SetFont('Helvetica', 'B', 11);
                $pdf->Write(0, $rs->cargoVia,'',0,'L');
                $pdf->Ln(10);
            }
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Cell(15, 5, 'De:');
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Write(0, $rs->nombreRemitente,'',0,'L');
            $pdf->Ln();            
            $pdf->Cell(15, 5, '');
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Write(0, $rs->cargoRemitente,'',0,'L');
            $pdf->Ln(10);
            $pdf->Cell(15, 5, 'Fecha:');
            $pdf->SetFont('Helvetica', '', 11); 
            $mes=(int)date('m',  $rs->fecha);
            $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
            $fecha=date('d',$rs->fecha).' de '.$meses[$mes].' de '.date('Y',$rs->fecha);
            $pdf->Write(0, $fecha,'',0,'L');
            $pdf->Ln(10);            
            $pdf->SetFont('Helvetica', 'B', 11); 
            $pdf->Cell(15, 5, 'Ref:');
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->MultiCell(170,5, $rs->referencia,0,'L');
            $pdf->Ln(10);
            $pdf->writeHTML($rs->contenido);
            $pdf->Ln(25);
            $pdf->SetFont('Helvetica', '', 6);
            $pdf->writeHTML('cc. ');
            $pdf->writeHTML(strtoupper($rs->copias));
         /*   $pdf->SetY(-5);
		// Set font
            $pdf->SetFont('helvetica', 'I', 7);
            $pdf->Write(0, $fecha,'',0,'L');
          * */
        }
        //echo "<BR><B>".date("r")."</B>";
   
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
