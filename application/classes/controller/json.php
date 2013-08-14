<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_json extends Controller{
    //lista de las noticias 
    public function action_noticias(){
        $noticias=  New Model_data();
        $notis=$noticias->noticias();     
        //$noticias=ORM::factory('comunicados')->where('tipo','=','1')->find_all()->as_array();
        echo json_encode($notis);
    }
    public function action_sigla(){
        $sigla=ORM::factory('oficinas',HTML::chars(Arr::get($_POST, 'id')));
        echo $sigla->sigla;
    }
    public function action_derivar($id=''){
   if ($this->request->is_ajax()) {
    echo 'sss';// Screw the master template
    // Do something shiny
} else {
    echo 'sss';// Fall back to standard page view
}
    }
    
    
    
    public function action_editarWord(){         
        $PHPWord = new PHPWord();

        // New portrait section
        $section = $PHPWord->createSection();

    // Add header
    $header = $section->createHeader();
    $table = $header->addTable();
    $table->addRow();
    $table->addCell(4500)->addText('This is the header.');
   // $table->addCell(4500)->addImage('_earth.jpg', array('width'=>50, 'height'=>50, 'align'=>'right'));

// Add footer
    $footer = $section->createFooter();
    $footer->addPreserveText('Página {PAGE} de {NUMPAGES}.', array('align'=>'center'));

// Write some text
    $section->addTextBreak();
    $section->addText('Some text...');

// Save File
    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');        
    $objWriter->save('documentos/aa.docx');
        header ("Content-Disposition: attachment; filename=x.docx\n\n");
        header ("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header ("Content-Length: ".filesize('temp/aa.docx'));
        readfile('temp/aa.docx');
    }
    
    
    
    
    
    
    
    
    //PROBANDO CON TCPDF
    public function action_pdf(){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
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
//$pdf->setLanguageArray($l);

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

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;
header('Content-type: application/pdf');
 header('Content-Disposition: attachment; filename="naAme.pdf"');
// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
echo $pdf->Output('example_0013.pdf', 'S');
    }
    
    
    
   }
?>
