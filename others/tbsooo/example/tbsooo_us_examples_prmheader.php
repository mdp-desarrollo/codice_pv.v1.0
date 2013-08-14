<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$result[0] = array('country'=>'United States', 'city'=>'Washington', 'winner'=>'Bob', 'score'=>100) ;
$result[1] = array('country'=>'United States', 'city'=>'Washington', 'winner'=>'Julia', 'score'=>99) ;
$result[2] = array('country'=>'United States', 'city'=>'Washington', 'winner'=>'Mark', 'score'=>78) ;
$result[3] = array('country'=>'United States', 'city'=>'New York', 'winner'=>'Stanley', 'score'=>110) ;
$result[4] = array('country'=>'United States', 'city'=>'New York', 'winner'=>'Robert', 'score'=>109) ;
$result[5] = array('country'=>'France', 'city'=>'Paris', 'winner'=>'Pierre', 'score'=>250) ;
$result[6] = array('country'=>'France', 'city'=>'Paris', 'winner'=>'Jean', 'score'=>210) ;
$result[7] = array('country'=>'France', 'city'=>'Paris', 'winner'=>'Gaël', 'score'=>120) ;
$result[8] = array('country'=>'France', 'city'=>'Toulouse', 'winner'=>'Emmanuelle', 'score'=>260) ;
$result[9] = array('country'=>'France', 'city'=>'Toulouse', 'winner'=>'Louis', 'score'=>240) ;
$result[10] = array('country'=>'France', 'city'=>'Toulouse', 'winner'=>'Jaques', 'score'=>200) ;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_prmheader.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->MergeBlock('blk_res',$result) ;
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>