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
$cite=$rs->cite_original;
$titulo=$rs->titulo;
$institucion_destinatario=$rs->institucion_destinatario;
$nombre_destinatario=$rs->nombre_destinatario;
$cargo_destinatario=$rs->cargo_destinatario;
$nombre_via=$rs->nombre_via; //para informes con via
$cargo_via=$rs->cargo_via;  //para informes sin via
$nombre_remitente=$rs->nombre_remitente;
$cargo_remitente=$rs->cargo_remitente;
$fecha=Date('Y-m-d');
$referencia=$rs->referencia;
$hojaruta=$rs->nur;
$copias=$rs->copias;
$contenido=strip_tags(html_entity_decode($rs->contenido));
//pie de pagina
$pie_1=$rs->pie_1;
$pie_2=$rs->pie_2;
// Load the template
$TBS->LoadTemplate($template);
// delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
// Define the name of the output file
$file_name = str_replace('.','_'.date('Y-m-d').'.',$template);

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