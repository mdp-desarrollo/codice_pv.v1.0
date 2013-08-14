<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$blk_query  = array();
$blk_query[]= array('fn' => 'Joe',   'sn' => 'Smith',   'mark' => '56');
$blk_query[]= array('fn' => 'Fred',  'sn' => 'Jones',   'mark' => '78');
$blk_query[]= array('fn' => 'Sue',   'sn' => 'Kendall', 'mark' => '27');
$blk_query[]= array('fn' => 'Helen', 'sn' => 'Nguyen',  'mark' => '84');

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('one_row_per_page_break.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');

$OOo->MergeBlock('blk1', $blk_query) ;
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc(true);
$OOo->DeleteDoc();
?>