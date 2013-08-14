<?php
include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// datas
$data_array[] = array('res_name'=>'Marie','res_score'=>300, 'res_date'=>'2003-01-10') ;
$data_array[] = array('res_name'=>'Eric', 'res_score'=>215, 'res_date'=>'2003-01-10') ;
$data_array[] = array('res_name'=>'Mark', 'res_score'=>180, 'res_date'=>'2003-01-10') ;
$data_array[] = array('res_name'=>'Paul', 'res_score'=>175, 'res_date'=>'2003-01-10') ;
$data_array[] = array('res_name'=>'Math', 'res_score'=>120, 'res_date'=>'2003-01-10') ;
$data_array[] = array('res_name'=>'Lucy', 'res_score'=>115, 'res_date'=>'2003-01-10') ;

//event function
function m_event_b1($BlockName,&$CurrRec,&$DetailSrc,$RecNum){
  //$BlockName : name of the block that calls the function (read only)
  //$CurrRec   : array that contains columns of the current record (read/write)
  //$DetailSrc : source of the current section (read/write)
  //$RecNum    : number of the current record (read only)
  if ($RecNum==1) $CurrRec['res_name'] = $CurrRec['res_name']. ' (WINS)' ;
  if ($CurrRec['res_score']<100)  $CurrRec['level'] = 'bad' ;
  if ($CurrRec['res_score']>=100) $CurrRec['level'] = 'middle' ;
  if ($CurrRec['res_score']>=200) $CurrRec['level'] = 'good' ;
  if ($CurrRec['res_score']>=300) $CurrRec['level'] = 'excellent' ;
}

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// setting the object
$OOo->SetZipBinary('zip');
$OOo->SetUnzipBinary('unzip');
$OOo->SetProcessDir('tmp/');

// create a new openoffice document from the template with an unique id 
$OOo->NewDocFromTpl('tbsooo_us_examples_event.sxw');

// merge data with openoffice file named 'content.xml'
$OOo->LoadXmlFromDoc('content.xml');
$OOo->MergeBlock('b1',$data_array) ;
$OOo->SaveXmlToDoc();

// display
header('Content-type: '.$OOo->GetMimetypeDoc());
header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
$OOo->FlushDoc();
$OOo->RemoveDoc();
?>