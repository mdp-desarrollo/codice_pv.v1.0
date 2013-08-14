<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// request
$empty = (isset($_GET['empty']) ? $_GET['empty'] : 0 );

// datas
if ($empty) {
	$url = '' ;
	$image = '' ;
	$line1 = '1 New Avenue' ;
	$line2 = '' ;
} else {
	$url = 'www.tinybutstrong.com' ;
	$image = 'tbsooo_us_examples_prmmagnet.gif' ;
	$line1 = '2 Main Street' ;
	$line2 = '3rd floor' ;
}

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_prmmagnet.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>