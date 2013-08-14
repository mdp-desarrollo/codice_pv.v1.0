<?php
	include 'html2doc.php';	
	$htmltodoc= new HTML_TO_DOC();
	$htmltodoc->createDoc('<html><head><title>Documento</title></head><body><b>Espero funciones...</b></body></html>','test');
?>