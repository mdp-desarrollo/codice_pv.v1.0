<?php
function __autoload($class) {
	$path = "../WordElements/PropertyElements/$class.php";
	if (!file_exists($path)) {
		$path = "../WordElements/$class.php";
	}
	if (!file_exists($path)) {
    $path = "../WordStyleElements/$class.php";
	}
	if (!file_exists($path)) {
		$path = "../$class.php";
	}
	include_once($path);
}

$doc = new OpenXML_WordDocument();

/*Create Some Content*/
$doc->AddStyleDocument()->GetDefaults()->GetRunDefaults()->SetFontSize(100);
$doc->AddStyleDocument()->GetDefaults()->GetParagraphDefaults()->SetSpacing(120);

$doc->GetBody()->AppendParagraph('main')->AppendRun('main')->AppendText('Hello world');

$doc->SaveDocument('test_'.date('d-m-Y (H i s)',time()), '');

//echo $doc->saveXML();