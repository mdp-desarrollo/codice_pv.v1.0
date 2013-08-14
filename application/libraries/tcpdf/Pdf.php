<?php

class pdf_core{
public function action_index(){
    $pagina=  URL::base().'tcpdf/examples/example_001.php';
    
    Header("Location: $pagina"); 
    echo $pagina;

}   

public static function action_pdf($id=''){
 
   require_once('tcpdf/config/lang/spa.php');
   require_once('tcpdf/tcpdf.php');
   
   
   
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ministerio de Desarrollo Productivo y Economia Plural');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, infomre, carta, circular');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
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

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

//conexion a la base de datos
$documento=  ORM::factory('documentos')->join('tipodocumentos','INNER')
                                       ->on('documentos.tipodocumento','=','tipodocumentos.id')
                                       ->where('documentos.id','=',$id)
                                        ->find();
$pdf->Cell(10, 0, $documento->tituloDestinatario, 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(0, 5, $documento->nombreDestinatario, 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(0, 15, $documento->cargoDestinatario, 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$html=$documento->contenido;
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);

$pdf->AddPage();
// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename=".$documento->codigo.".pdf");
echo $pdf->Output('', 'S');
//$content=$pdf->Output('', 'S');

/*$this->template=View::factory('template')
              ->bind('content', $content);
 * 
 */
}

}

?>
