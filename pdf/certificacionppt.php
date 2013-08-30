<?php

require_once('../libs/tcpdf/config/lang/eng.php');
require_once('../libs/tcpdf/tcpdf.php');
require_once('../db/dbclass.php');
$id = $_GET['id'];
$id_fucov = $_GET['f'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    
    //Page header
    public function Header() {
        
        
        
        $id = $_GET['id'];
        $dbh = New db();
        $stmt = $dbh->prepare("SELECT c.logo,c.id FROM documentos AS a INNER JOIN oficinas AS b ON a.id_oficina = b.id
INNER JOIN entidades AS c ON b.id_entidad = c.id WHERE a.id = '$id'");
        $stmt->execute();
        //echo "<B>outputting...</B><BR>";
        $image_file = 'logo.jpg';
        while ($rs2 = $stmt->fetch(PDO::FETCH_OBJ)) {
            if ($rs2->logo) {
                $image_file = '../media/logos/' . $rs2->logo;
            }
            $id_entidad=$rs2->id;
        }
        if($id_entidad<>2){
        $this->Image($image_file, 20, 7, 40, 23, 'PNG');
        }
        $this->SetFont('helvetica', 'B', 20);        
    }

    // Page footer
    public function Footer() {
        $id = $_GET['id'];
        $dbh = New db();
        $stmt = $dbh->prepare("SELECT e.pie_1,e.pie_2,e.id FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               INNER JOIN oficinas o ON d.id_oficina=o.id
                               INNER JOIN entidades e ON o.id_entidad=e.id
                               WHERE d.id='$id'");
        $stmt->execute();
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $pie1 = $rs->pie_1;
            $pie2 = $rs->pie_2;
            $id_entidad=$rs->id;
        }
        if($id_entidad<>2){
        // Linea vertical negra
            
        $style = array('width' => 1.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));
        $this->Line(140, 257, 140, 272, $style);
        // logo quinua
        $this->Image('../media/logos/logo_quinua.jpg', 140, 253, 40, 22, 'JPG');
        // Pie de pagina
        $this->SetFont('helvetica', 'I', 7);
        $this->MultiCell(85, 0, $pie1, 0, 'R', false, 1, 50, 260, true, 0, false, true, 0, 'T', false);
        $this->MultiCell(90, 0, $pie2, 0, 'R', false, 1, 45, 266, true, 0, false, true, 0, 'T', false);
        $this->SetY(30);
        }
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('DOCUMENTO');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(20, 33, 20);
//$pdf->SetMargins(20, PDF_MARGIN_TOP, 20);
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
$nombre = 'cert_ppto';
try {
    $dbh = New db();
    $stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               WHERE d.id='$id'");
    // call the stored procedure
    $stmt->execute();
    //echo "<B>outputting...</B><BR>";
    //$pdf->Ln(7);
    //while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Write(0, strtoupper($rs->tipo), '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Write(0, strtoupper($rs->codigo), '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B', 13);
        $pdf->Write(0, strtoupper($rs->nur), '', 0, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(15, 5, 'A:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Write(0, utf8_encode($rs->nombre_destinatario), '', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(15, 5, '');
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, utf8_encode($rs->cargo_destinatario), '', 0, 'L');
        $pdf->Ln(10);
        if (($rs->via != 0) && (trim($rs->nombre_via) != '')) {
            $pdf->SetFont('Helvetica', 'B', 10);
            $pdf->Cell(15, 5, 'Via:');
            $pdf->SetFont('Helvetica', '', 10);
            $pdf->Write(0, utf8_encode($rs->nombre_via), '', 0, 'L');
            $pdf->Ln();
            $pdf->Cell(15, 5, '');
            $pdf->SetFont('Helvetica', 'B', 10);
            $pdf->Write(0, utf8_encode($rs->cargo_via), '', 0, 'L');
            $pdf->Ln(10);
        }
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(15, 5, 'De:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Write(0, utf8_encode($rs->nombre_remitente), '', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(15, 5, '');
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, utf8_encode($rs->cargo_remitente), '', 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(15, 5, 'Fecha:');
        $pdf->SetFont('Helvetica', '', 10);
        $mes = (int) date('m', strtotime($rs->fecha_creacion));
        $meses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
        $fecha = date('d', strtotime($rs->fecha_creacion)) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime($rs->fecha_creacion));
        $pdf->Write(0, $fecha, '', 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(15, 5, 'Ref:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->MultiCell(170, 5, utf8_encode($rs->referencia), 0, 'L');
        $pdf->Ln(10);
        $pdf->writeHTML($rs->contenido);

        //$pdf->writeHTML();
        /*   $pdf->SetY(-5);
          // Set font
          $pdf->SetFont('helvetica', 'I', 7);
          $pdf->Write(0, $fecha,'',0,'L');
         * */

//        $nombre.='_' . substr($rs->cite_original, -10, 6);
    //}
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'B', 13);
    $pdf->write(0,'CERTIFICACION POA','',0,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', 'B', 15);
    $pdf->write(0,'__________________________________________________________','',0,'C');
    //$dbh = New db();
    $stmt = $dbh->prepare("select p.fecha_certificacion, og.codigo cod_gestion, og.objetivo obj_gestion, oe.codigo cod_especifico, oe.objetivo obj_especifico
from pvpoas p inner join pvogestiones og on p.id_obj_gestion = og.id inner join pvoespecificos oe on p.id_obj_esp = oe.id where id_fucov ='$id_fucov'");
    $stmt->execute();
    $rsi = $stmt->fetch(PDO::FETCH_OBJ);
    $pdf->SetFont('Helvetica', '', 11);
    //$pdf->Write(0, 'Objetivo Gestion: '.$rsi->obj_gestion, '', 0, 'L');
    //$pdf->Ln();
    $html = "
        <table style=\" width: 100%;\"  border=\"0px\">
            <tr>
                <td style = \" width: 30%;\">OBJETIVO GESTION</td>
                <td style = \" width: 10%;\">:$rsi->cod_gestion</td>
                <td style = \" width: 65%;\">$rsi->obj_gestion</td>
            </tr>
            <tr>
            <td colspan=\"3\"></td>
            </tr>
            <tr>
                <td>OBJETIVO ESPECIFICO</td>
                <td>:$rsi->cod_especifico</td>
                <td>$rsi->obj_especifico</td>
            </tr>
            <tr>
                <td colspan=\"3\"></td>
            </tr>
            <tr>
                <td>FECHA CERTIFICACION</td>
                <td></td>
                <td>:$rsi->fecha_certificacion</td>
            </tr>
            <tr>
                <td colspan=\"3\"></td>
            </tr>
        </table>";
        $pdf->Ln(20);
        $pdf->writeHTML($html, false, false, false);
        
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', '', 5);
        $pdf->writeHTML('cc. ' . strtoupper($rs->copias));
        $pdf->writeHTML('Adj. ' . strtoupper($rs->adjuntos));
        $pdf->writeHTML(strtoupper($rs->mosca_remitente));
        $nombre.='_' . substr($rs->cite_original, -10, 6);
        
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Close and output PDF document
$pdf->Output($nombre . '.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
