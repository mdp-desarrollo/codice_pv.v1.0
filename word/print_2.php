<?php
if(isset($_GET['id'])):
$id=$_GET['id'];
require_once '../db/dbclass.php';

//MOD-------------------------------------------------------------------------
require_once '../libs/phpWord/PHPWord.php';
require_once '../libs/simplehtmldom/simple_html_dom.php';
require_once '../libs/htmltodocx_converter/h2d_htmlconverter.php';
require_once '../libs/example_files/styles.inc';

//consulta de la bd
$dbh=New db();
$stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               INNER JOIN oficinas o ON d.id_oficina=o.id
                               INNER JOIN entidades e ON o.id_entidad=e.id
                               WHERE d.id='$id'");
$stmt->execute();              
$rs = $stmt->fetch(PDO::FETCH_OBJ); 
$html = $rs->contenido;
 
// New Word Document:
$phpword_object = new PHPWord();
//$section = $phpword_object->createSection();
//tipo de fuente
//$phpword_object->setDefaultFontName('Calibri');
$sectionStyle = array(/*'orientation' => null,*/
			    'marginLeft' => 1500,
			    'marginRight' => 1500,
			    'marginTop' => 840,
			    'marginBottom' => 1417,
                'pageSizeW' => '12240',
                'pageSizeH' => '15840',);
$section = $phpword_object->createSection($sectionStyle);


// HEADER
/*$header = $section->createHeader();
$table = $header->addTable();
$table->addRow();
//$table->addCell(4500)->addText('This is the header.');
//$table->addCell(10000)->addImage('logo.png', array('width'=>225, 'height'=>150, 'align'=>'center' ));
//$table->addCell(10000)->addImage('../media/logos/logo_senapi.png', array('width'=>120, 'height'=>100, 'align'=>'center' ));
$table->addCell(10000)->addImage('../media/logos/'.$rs->logo, array('width'=>120, 'height'=>100, 'align'=>'center' ));
*/

//Logo
$imageStyle = array('width'=>140, 'height'=>90, 'align'=>'center');
$section->addImage('../media/logos/'.$rs->logo, $imageStyle);



// Write some text
//$section->addTitle('I am Title 1', 2,'center');
//$section->addParagraph('I am Title 1', 2);
/*
$textrun = $section->createTextRun();
$textrun->addText('I am bold', array('bold'=>true),array('align'=>'center')); 
$textrun->addText('I am italic', array('italic'=>true));
$textrun->addText('I am colored', array('color'=>'AACC00'));

$section->addText('sssssssS', array('bold'=>true),array('align'=>'center'));
*/
/*$fontStyle = array('color'=>'006699', 'size'=>18, 'bold'=>true, 'align'=>'center');
$paragraphStyle = array('align'=>'center');
$section->addText('helloWorld', $fontStyle);
$section->addText('helloWorld Again', $paragraphStyle);*/

/*TITULO*/
//$section->addTextBreak();
$section->addText(strtoupper($rs->tipo),array('bold'=>true,'size'=>15),array('align'=>'center','spaceBefore'=>180,'spaceAfter'=>0,'spacing'=>1));
$section->addText($rs->cite_original,array('bold'=>false,'size'=>10),array('align'=>'center','spaceBefore'=>20,'spaceAfter'=>0,'spacing'=>1));
$section->addText($rs->nur,array('bold'=>true,'size'=>11),array('align'=>'center'));


// Realizado por freddy


//INICIO DAtos Del Documento
$section->addText('A:          '.$rs->nombre_destinatario,array('size'=>10),array('spaceBefore'=>0,'spaceAfter'=>0,'spacing'=>5));
$section->addText('            '.$rs->cargo_destinatario,array('bold'=>true,'size'=>11));


//


//$section->addTextBreak();
if(trim($rs->nombre_via)!=''){
    $section->addText('Via:       '.$rs->nombre_via,array('size'=>10),array('spaceBefore'=>0,'spaceAfter'=>0,'spacing'=>0));
    $section->addText('              '.$rs->cargo_via,array('bold'=>true,'size'=>10));
}
//$section->addTextBreak();
$section->addText('De         '.$rs->nombre_remitente,array('size'=>10),array('spaceBefore'=>0,'spaceAfter'=>0,'spacing'=>0));
$section->addText('              '.$rs->cargo_remitente,array('bold'=>true,'size'=>10));

//FECHA--
$xfecha=Date('Y-m-d');
$meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
$xdia = substr($xfecha, 8, 2);
$xmes   = substr($xfecha, 5, 2);
$xmes = (int)($xmes);
$xanio = substr($xfecha,0,4);

//$section->addTextBreak();
$section->addText('Fecha:   '.$xdia. ' de '. $meses[$xmes] . ' de '. $xanio,array('size'=>10));

//Referencia
$section->addText('Ref.:     '.$rs->referencia,array('size'=>10,'bold'=>true));
//$section->addText('Ref.:    '.$rs->referencia,array('size'=>10,'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE,'bold'=>true));
$section->addTextBreak();

//Fin DAtos Del Documento


// HTML Dom object:
$html_dom = new simple_html_dom();
$html_dom->load('<html><body>' . $html . '</body></html>');

//$html_dom->load('<html><body>' . $html . '</body></html>');
// Note, we needed to nest the html in a couple of dummy elements.

// Create the dom array of elements which we are going to work on:
$html_dom_array = $html_dom->find('html',0)->children();

// Provide some initial settings:
$initial_state = array(
  // Required parameters:
  'phpword_object' => &$phpword_object, // Must be passed by reference.
  'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
  'base_path' => '/htmltodocx/', // Path from base_root to whatever url your links are relative to.
  
  // Optional parameters - showing the defaults if you don't set anything:
  'current_style' => array('size' => '10'), // The PHPWord style on the top element - may be inherited by descendent elements.
  'parents' => array(0 => 'body'), // Our parent is body.
  'list_depth' => 0, // This is the current depth of any current list.
 // 'context' => 'section', // Possible values - section, footer or header.
  'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
  'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
  'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
  'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
  'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
  'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
      
  // Optional - no default:    
  'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
  );    

// Convert the HTML and put it into the PHPWord object
htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);

//MOD--Create footer
$footer = $section->createFooter();
$footer->addText('___________________________________________________________________________________','',array('spaceBefore'=>0,'spaceAfter'=>0,'spacing'=>0));
$footer->addText($rs->pie_1,array('italic'=>true,'size'=>7, 'name'=>'Calibri'),array('spaceBefore'=>0,'spaceAfter'=>0,'spacing'=>0, 'align'=>'center' ));
$footer->addText($rs->pie_2,array('italic'=>true,'size'=>7, 'name'=>'Calibri'),array('spaceBefore'=>0,'spaceAfter'=>0,'spacing'=>0, 'align'=>'center' ));
/*$table = $footer->addTable();
$table->addRow();
$table->addCell(4500)->addText($rs->pie_1,array('italic'=>true,'size'=>8));
//$table->addCell(4500)->addImage('_mars.jpg', array('width'=>50, 'height'=>50, 'align'=>'right'));
$table->addRow();
$table->addCell(4500)->addText($rs->pie_2);*/

//$footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('align'=>'center'));


// Clear the HTML dom object:
$html_dom->clear(); 
unset($html_dom);

// Save File
$h2d_file_uri = tempnam('', 'htd');
$objWriter = PHPWord_IOFactory::createWriter($phpword_object, 'Word2007');
$objWriter->save($h2d_file_uri);

// Download the file:
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
//header('Content-Disposition: attachment; filename=example.docx');
header('Content-Disposition: attachment; filename='.$rs->action.'_'.substr($rs->cite_original,-9,5).'.docx');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($h2d_file_uri));
ob_clean();
flush();
$status = readfile($h2d_file_uri);
unlink($h2d_file_uri);
exit;

//----------------------------------------------------------------------------
/*
$dbh=New db();

$stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               INNER JOIN oficinas o ON d.id_oficina=o.id
                               INNER JOIN entidades e ON o.id_entidad=e.id
                               WHERE d.id='$id'");
$stmt->execute();              
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) 
{        
// Display this code source is asked.
if (isset($_GET['source'])) exit('<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>OpenTBS plug-in for TinyButStrong - demo source</title></head><body>'.highlight_file(__FILE__,true).'</body></html>');

// load the TinyButStrong libraries
include_once('tbs_class_php5.php'); // TinyButStrong template engine

// load the OpenTBS plugin
include_once('tbs_plugin_opentbs.php');
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load OpenTBS plugin
//cargamos el template segun el tipo de documento
if(trim($rs->nombre_via)=='')
    $template='templates/'.$rs->action.'.docx';
else
    $template='templates/'.$rs->action.'_via.docx';
$debug=2;
$suffix='';
$tipo=strtoupper($rs->tipo);
$cite=''.$rs->cite_original;
$titulo=''.$rs->titulo;
$institucion_destinatario=''.$rs->institucion_destinatario;
$nombre_destinatario=''.$rs->nombre_destinatario;
$cargo_destinatario=''.$rs->cargo_destinatario;
$nombre_via=''.$rs->nombre_via; //para informes con via
$cargo_via=''.$rs->cargo_via;  //para informes sin via
$nombre_remitente=''.$rs->nombre_remitente;
$cargo_remitente=''.$rs->cargo_remitente;
//$imagen_file = $imagen_file2;

$xfecha=Date('Y-m-d');
$meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
$xdia = substr($xfecha, 8, 2);
$xmes   = substr($xfecha, 5, 2);
$xmes = (int)($xmes);
$xanio = substr($xfecha,0,4);
$fecha = $xdia. ' de '. $meses[$xmes] . ' de '. $xanio;

//$fecha=Date('Y-m-d');

$referencia=''.$rs->referencia;
$hojaruta=''.$rs->nur;
$copias=''.$rs->copias;
$contenido=strip_tags(html_entity_decode(''.$rs->contenido));
//logo
$data=array();
$data[]=array('number'=>'../media/logos/'.$rs->logo);
//pie de pagina
$pie_1=''.$rs->pie_1;
$pie_2=''.$rs->pie_2;
// Load the template
$TBS->LoadTemplate($template);
$TBS->MergeBlock('a,b', $data);

// delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
// Define the name of the output file
$file_name = $rs->action.'_'.substr($rs->cite_original,-9,5).'.docx';

// Output as a download file (some automatic fields are merged here)
if ($debug==3) { // debug mode 3
	$TBS->Plugin(OPENTBS_DEBUG_XML_SHOW);
} elseif ($suffix==='') {
	// download
	$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
} else {
	// save as file
	$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	$TBS->Show(OPENTBS_FILE+TBS_EXIT, $file_name);
}

}
*/
else:
    exit;

endif;