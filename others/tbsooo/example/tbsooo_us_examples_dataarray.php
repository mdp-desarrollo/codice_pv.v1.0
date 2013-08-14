<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$array_type1 = array(); 
$array_type1 = array('France'=>33, 'England'=>44, 'Spain'=>34, 'Italy'=>39, 'Deutchland'=>49) ;

$array_type2[] = array('res_name'=>'Marie', 'res_score'=>300, 'res_date'=>'2003-01-10');
$array_type2[] = array('res_name'=>'Eric',  'res_score'=>215, 'res_date'=>'2003-01-10');
$array_type2[] = array('res_name'=>'Mark',  'res_score'=>180, 'res_date'=>'2003-01-10');
$array_type2[] = array('res_name'=>'Paul',  'res_score'=>175, 'res_date'=>'2003-01-10');
$array_type2[] = array('res_name'=>'Mat',   'res_score'=>120, 'res_date'=>'2003-01-10');
$array_type2[] = array('res_name'=>'Sonia', 'res_score'=>115, 'res_date'=>'2003-01-10');

$all_array['type1'] = $array_type1;
$all_array['type2'] = $array_type2;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_dataarray.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->MergeBlock('blk1',$array_type1) ;
$OOo->MergeBlock('blk2',$array_type2) ;
$OOo->MergeBlock('blk3','array','all_array[type2]') ;
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>