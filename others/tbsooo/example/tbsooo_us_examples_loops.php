<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$nbr = (isset($_GET['nbr']) ? $_GET['nbr'] : 30);

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_loops.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');


//We get the HTML source that designs the block
$row_tpl = $OOo->GetBlockSource('blk1') ;

//Variables initialization
$row_list = '' ;
$i = 1 ;

//Starting the loop
while ($i<=$nbr) {
  $row_curr = $row_tpl ;
  for ($cell=1;$cell<=7;$cell++) {
	  if ($i<=$nbr) {
		  $row_curr = str_replace('x'.$cell,$i,$row_curr) ;
		} else {
		  $row_curr = str_replace('x'.$cell,'&nbsp;',$row_curr) ;
		}
	  $i++ ;
	}
	$row_list .=  $row_curr ;
}

$OOo->MergeBlock('blk1','text',$row_list) ;
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>