<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$amount = 3.55;
$task['monday'] = '<cooking>';

class clsObj {
	var $param = 'hello';
}
$obj = new clsObj;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
//$OOo->SetZipBinary('/usr/bin/zip');
//$OOo->SetUnzipBinary('/usr/bin/unzip');

$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_var.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>