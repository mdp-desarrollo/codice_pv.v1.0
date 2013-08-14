<?php
require_once('../libs/tcpdf/config/lang/eng.php');
require_once('../libs/tcpdf/tcpdf.php');
include('../db/dbclass.php');
$id=$_GET['id'];  
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
        public $datatime;
        public $meses;
        public $dias;
        public $dia;
        public $mes;
	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'logo.jpg';
		$this->Image($image_file, 86, 2, 40, '', 'JPG');
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
                $this->Ln();
		$this->Cell(0, 30, '', 'B', false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 7);
		// Page number
		//$this->Cell(0, 10, 'Av. Mariscal Santa Cruz, Edif. Palacio de Comunicaciones Piso 20 - Telefono(2124935-40)-2124933'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 10, 'Av. Mariscal Santa Cruz, Edif. Palacio de Comunicaciones Piso 20 - Telefono(2124935-40)-2124933, Fax: 212913 - Casilla 1868', 'T', false, 'C', 0, '', 0, false, 'T', 'M');
                $this->Ln(2);
		$this->Cell(0, 15, 'La Paz - Bolivia', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}        
        public function get_fecha($fecha)
        {
            $this->datatime=strtotime($fecha);
            $this->meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');            
            $this->dias=array(1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',0=>'Domingo');
            $this->mes=(int)date('m',$this->datatime);                       
            $this->mes=$this->meses[$this->mes]; 
            //dia
            $this->dia=(int)date('w',$this->datatime);                       
            $this->dia=$this->dias[$this->dia];                        
            //retornamos
            return $this->dia.', '.date('d',$this->datatime).' de '.$this->mes.' de '.date('Y',$this->datatime);  
        }
        
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ivan Marcelo Chacolla');
$pdf->SetTitle('DOCUMENTO');
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
$pdf->SetMargins(20, PDF_MARGIN_TOP, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

$pdf->SetFont('Helvetica', 'B', 18);

// add a page
$pdf->AddPage();
$nombre='Carta';
try {        
        $dbh=New db();      
        $stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               WHERE d.id='$id'");
        // call the stored procedure
        $stmt->execute();                
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $pdf->SetFont('Helvetica', '', 11);            
            $pdf->Write(0, $pdf->get_fecha($rs->fecha_creacion),'',0,'R');
            $pdf->Ln();
            $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->Write(0, strtoupper($rs->codigo),'',0,'R');
            $pdf->Ln(20);

            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Cell(15, 5, $rs->titulo); 
            $pdf->Ln();            
            $pdf->Write(0, $rs->titulo,'',0,'L');
            $pdf->Ln();            
            $pdf->Write(0, $rs->nombre_destinatario,'',0,'L');
            $pdf->Ln();            
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Write(0, $rs->cargo_destinatario,'',0,'L');
            $pdf->Ln();            
            $pdf->Write(0, $rs->institucion_destinatario,'',0,'L');
            $pdf->Ln();            
            $pdf->SetFont('Helvetica', '', 11);            
            $pdf->Write(0, 'Presente:','',0,'L');
            $pdf->Ln(10);            
            $pdf->SetFont('Helvetica', '', 11); 
            $pdf->Cell(15, 5, 'REF.:');
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->MultiCell(170,5, $rs->referencia,0,'L');
            $pdf->Ln(20);
            
            $pdf->writeHTML($rs->contenido);
            $pdf->Ln(40);
                        

            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Write(0, $rs->nombre_remitente,'',0,'C');
            $pdf->Ln();            
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Write(0, $rs->cargo_remitente,'',0,'C');            
         /*   $pdf->SetY(-5);
		// Set font
            $pdf->SetFont('helvetica', 'I', 7);
            $pdf->Write(0, $fecha,'',0,'L');
          * */
            
            $nombre.='_'.substr($rs->cite_original,-10,6);
        }
   
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
//Close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
