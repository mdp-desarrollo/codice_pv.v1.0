<?php
// ============================================================================
// I N C L U D E
// ============================================================================

include_once('../tbs_class.php');
include_once('../tbsooo_class.php');

// ============================================================================
// R E Q U E S T
// ============================================================================

$header = (isset($_GET['header']) ? $_GET['header'] : 'content');

// ============================================================================
// I N I T
// ============================================================================

// instantiate a TBS OOo class
$OOo = new clsTinyButStrongOOo;

// set the binary ZIP
//$OOo->SetZipBinary('/usr/bin/zip', true);
if ($OOo->SetZipBinary('zip', true) == false) {
  die;
}

// set the binary UNZIP
//$OOo->SetUnzipBinary('/usr/bin/unzip', true);
if ($OOo->SetUnzipBinary('unzip', true) == false) {
  die;
}

// set the process directory
if ($OOo->SetProcessDir('tmp/') == false) {
  die;
}

// ============================================================================
// D A T A S
// ============================================================================

// globals
$i_invoice  = '05123456';
$d_invoice  = '2005-07-06';
$f_vat_rate = 19.6;

// block for shipping address
$blk_ship  = array();
$blk_ship[]= array('s_lastname' => 'skrol29@freesurf.fr', 's_firstname' => '', 's_company' => 'RMLL', 's_adress1' => 'Faculté des sciences Mirande',  's_adress2' => '6 bd Gabriel', 's_adress3' => '', 's_city' => 'DIJON', 's_zip' => '21000', 's_country' => 'France');

// block for content of invoice
$blk_content  = array();
$blk_content[]= array('i_num' => 1,  's_ref' => '3400507000089', 's_ean' => '', 's_design' => 'BODY tag T-Shirt'                    , 'f_eur' => 14.99,  'f_teur' => 0);
$blk_content[]= array('i_num' => 2,  's_ref' => '3400507000119', 's_ean' => '', 's_design' => 'SQL query  T-Shirt'                  , 'f_eur' => 16.99,  'f_teur' => 0);
$blk_content[]= array('i_num' => 1,  's_ref' => '7209701000118', 's_ean' => '', 's_design' => 'Pocketec USB 2.0 Portable Hard Drive', 'f_eur' => 259.99, 'f_teur' => 0);
$blk_content[]= array('i_num' => 1,  's_ref' => '7610507000040', 's_ean' => '', 's_design' => 'Desktop Personal Air Conditioner'    , 'f_eur' => 19.99,  'f_teur' => 0);
$blk_content[]= array('i_num' => 10, 's_ref' => '3300501000057', 's_ean' => '', 's_design' => 'Caffeine Candy Sampler v5.0'         , 'f_eur' => 19.99,  'f_teur' => 0);

// compute invoice sum
$f_total = 0;
while (list($id, $fd) = each($blk_content)) {
  $blk_content[$id]['f_teur'] = $blk_content[$id]['i_num'] * $blk_content[$id]['f_eur'];
  $f_total+= $blk_content[$id]['f_teur'];
}
$f_gtotal   = $f_total * (1+$f_vat_rate/100);
$f_vat      = $f_gtotal - $f_total;

// ============================================================================
// M A I N
// ============================================================================

$OOo->NewDocFromTpl('example_invoice.sxw');

// ===== xml content ==========================================================
$OOo->LoadXmlFromDoc('content.xml');
$OOo->MergeBlock('blk_ship'   , 'array', $blk_ship);
$OOo->MergeBlock('blk_content', 'array', $blk_content);
$OOo->SaveXmlToDoc();

// ===== xml meta =============================================================
$OOo->LoadXmlFromDoc('meta.xml');
$OOo->SaveXmlToDoc();

// ============================================================================
// D I S P L A Y
// ============================================================================

switch ($header) {
  // method 1 : send to the browser via header location (problem with IE)
  case 'location':
    header('Location:'.$OOo->GetPathnameDoc());
    break;

  // method 2 : send to the browser via header content-type
  case 'content':
  default:
    header('Content-type: '.$OOo->GetMimetypeDoc());
    header('Content-Length: '.filesize($OOo->GetPathnameDoc()));
    $OOo->FlushDoc();
    $OOo->RemoveDoc();
    break;
}

// ============================================================================
// E N D
// ============================================================================

// clean old files in process dir (default files older than 2 hours)
$OOo->ClearProcessDir(2, 0);
?>