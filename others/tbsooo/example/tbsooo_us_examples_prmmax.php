<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$name1 = 'Marilyn Monroe' ;
$name2 = 'Fred Astaire' ;
$name3 = 'Ginger Rogers' ;
$name4 = 'James Dean' ;
$name5 = 'Grace Kelly' ;
$name6 = 'Rita Hayworth' ;
$name7 = 'Bette Davis' ;
$name8 = 'Greta Garbo' ;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_prmmax.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>