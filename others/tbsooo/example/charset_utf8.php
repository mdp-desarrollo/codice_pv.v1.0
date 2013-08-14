<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$x = 'Hello World';
$d = '2005-10-04';
$n = 0.1234;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');
$OOo->SetDataCharset('UTF8');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('charset_utf8.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>