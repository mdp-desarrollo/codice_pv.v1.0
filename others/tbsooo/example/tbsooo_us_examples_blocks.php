<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$country = array('France','England','Spain','Italy','Germany') ;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_blocks.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');

$OOo->MergeBlock('blk1',$country) ;
$OOo->MergeBlock('blk2',$country) ;
$OOo->MergeBlock('blk3',$country) ;
$OOo->MergeBlock('blk4',$country) ;
$OOo->MergeBlock('blk5',$country) ;

$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc(true);
$OOo->DeleteDoc();
?>