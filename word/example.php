<?php
$html='<html><head><title>r0salinda</title></head><body>
<div>golasd<b>asda</b></div>
</body></html>';
	include 'html2doc.php';
	
	$htmltodoc= new HTML_TO_DOC();
	$htmltodoc->createDoc($html,'test');
?>