<?php
if($_POST):
    $id_segs=array_values($_POST['id_seg']);
//print_r($id_segs);
require_once '../db/dbclass.php';
$dbh=New db();  
$sql="SELECT s.nur, s.a_oficina,s.nombre_receptor,cargo_receptor,s.fecha_emision,s.oficial,d.cite_original, d.referencia,s.proveido FROM seguimiento s 
INNER JOIN nurs_documentos n ON s.nur=n.nur
INNER JOIN documentos d ON n.id_documento=d.id
WHERE d.original='1'
AND  s.id IN (";
    foreach ($_POST['id_seg'] as $k=>$v):
        $sql.=$v.", ";
    endforeach;
    $sql=substr($sql,0, -2);
    $sql.=")";
$stmt = $dbh->prepare($sql);
$data=array();
$i=1;
$stmt->execute();             
$oficial=array(0=>'Copia',1=>'Oficial');
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) 
{    
// Display this code source is asked.
//if (isset($_GET['source'])) exit('<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>OpenTBS plug-in for TinyButStrong - demo source</title></head><body>'.highlight_file(__FILE__,true).'</body></html>');
    $data[]=array(
        'i'=>$i,    
        'nur'=>$rs->nur,    
        'oficina'=>$rs->a_oficina,    
        'nombre'=>$rs->nombre_receptor,
        'cargo'=>$rs->cargo_receptor,
        'cite'=>$rs->cite_original,
        'proveido'=>$rs->proveido,
        'oficial'=>$oficial[$rs->oficial],
        'fecha'=>date('d/m/Y',  strtotime($rs->fecha_emision))
        );
    $i++;
}

// load the TinyButStrong libraries
include_once('tbs_class_php5.php'); // TinyButStrong template engine
// load the OpenTBS plugin
include_once('tbs_plugin_opentbs.php');
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load OpenTBS plugin
//cargamos el template segun el tipo de documento
$template='templates/demo_ms.xlsx';
$debug=0;
$suffix='';
$fecha=date('d/m/Y');
// Load the template
$TBS->LoadTemplate($template);

if ($debug==2) { // debug mode 2
	$TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT);
	exit;
} elseif ($debug==1) { // debug mode 1
	$TBS->Plugin(OPENTBS_DEBUG_INFO);
	exit;
}

$TBS->MergeBlock('a', $data);
// Define the name of the output file
// delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

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
else:
    print_r($_POST);
endif;