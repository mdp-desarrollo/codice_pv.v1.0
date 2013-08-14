<?php
if(isset($_GET['id'])):
$id=$_GET['id'];
require_once '../db/dbclass.php';
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

$adjuntos=''.$rs->adjuntos;
$mosca_remitente=''.$rs->mosca_remitente;

$contenido=strip_tags(html_entity_decode(''.$rs->contenido));       // original
//$contenido=''.$rs->contenido;


//logo
$data=array();
$data[]=array('number'=>'../media/logos/'.$rs->logo);
//pie de pagina
$pie_1=''.$rs->pie_1;
$pie_2=''.$rs->pie_2;
// Load the template
//$TBS->LoadTemplate($template);
$TBS->LoadTemplate($template,OPENTBS_ALREADY_UTF8);
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
else:
    exit;
endif;