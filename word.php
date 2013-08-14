<?php
require('word/dbclass.php');
$id=$_GET['id'];
$dbh = new db();
$stmt = $dbh->prepare("SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,
        d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,d.nur, t.tipo,d.contenido 
FROM documentos d
INNER JOIN tipos t ON t.id=d.id_tipo
WHERE d.id='$id'");        
$stmt->execute();        
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {   
    require_once 'libs/PHPWord/PHPWord.php';   
    // New Word Document
    $PHPWord = new PHPWord();
    if(trim($rs->nombreVia)==''){
    $document = $PHPWord->loadTemplate('temp/TemplatesinVia.docx');
    }
    else
    {
    $document = $PHPWord->loadTemplate('temp/Template.docx');
    $document->setValue('v1',$rs->nombreVia);
    $document->setValue('c1',$rs->cargoVia);
    }
    $document->setValue('tipo',  strtoupper($rs->tipo));
    $document->setValue('documento',$rs->codigo);
    $document->setValue('hoja',$rs->nur);
    $document->setValue('destino',$rs->nombreDestinatario);
    $document->setValue('cargo',$rs->cargoDestinatario);
    $document->setValue('remite',$rs->nombreRemitente);
    $document->setValue('valor',$rs->cargoRemitente);
    $mes=(int)date('m',  $rs->fecha_creacion);
    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
    $fecha=date('d',$rs->fecha_creacion).' de '.$meses[$mes].' de '.date('Y',$rs->fecha_creacion);
    $document->setValue('fecha', $fecha);
    $document->setValue('referencia', $rs->referencia);
    $document->setValue('contenido',  $rs->contenido);
    // Save File
    $filename=time(); 
    $filetemp='temp/'.$filename.'.docx';    
    $document->save($filetemp);
    header ("Content-Disposition: attachment; filename=".$filename.".docx\n\n");
    header ("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header ("Content-Length: ".filesize($filetemp));
    readfile($filetemp);        
}
?>