<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$recset[] = array('title'=>'I will love you'  , 'rank'=>'A') ;
$recset[] = array('title'=>'Tender thender'   , 'rank'=>'B') ;
$recset[] = array('title'=>'I got you babe'   , 'rank'=>'C') ;
$recset[] = array('title'=>'Only with you'    , 'rank'=>'D') ;
$recset[] = array('title'=>'Love me tender'   , 'rank'=>'E') ;
$recset[] = array('title'=>'Wait for me'      , 'rank'=>'F') ;
$recset[] = array('title'=>'Happy pop'        , 'rank'=>'G') ;
$recset[] = array('title'=>'Kiss me like that', 'rank'=>'H') ;
$recset[] = array('title'=>'Love me so'       , 'rank'=>'I') ;
$recset[] = array('title'=>'Us, you and I'    , 'rank'=>'J') ;

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_prmserial.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->MergeBlock('bx',$recset) ;
$OOo->MergeBlock('bz',$recset) ;
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>