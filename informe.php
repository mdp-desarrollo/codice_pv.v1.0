<?php
require_once 'db/dbclass.php';
require_once 'libs/PHPWord/PHPWord.php';
$id=$_GET['id'];
$dbh=New db();      
$stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               WHERE d.id='$id'");
$stmt->execute();              
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) 
{
    $PHPWord = new PHPWord();
    if(trim($rs->nombre_via)==''){
    $document = $PHPWord->loadTemplate('informe.docx');
    }
    else
    {
    $document = $PHPWord->loadTemplate('informe_via.docx');
    $document->setValue('v1',$rs->nombre_via);
    $document->setValue('c1',$rs->cargo_via);
    }
   // $document = $PHPWord->loadTemplate('sinvia.docx');
    $document->setValue('tipo',strtoupper($rs->tipo));
    $document->setValue('cite', $rs->cite_original);
    //inicio fecha
    $date=strtotime($rs->fecha_creacion);
    $mes=(int)date('m',  $date);
    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
    $fecha=date('d',$date).' de '.$meses[$mes].' de '.date('Y',$date);
    //fin fecha
    $document->setValue('fecha', $fecha);
    $document->setValue('referencia', $rs->referencia);
    $document->setValue('hoja', $rs->nur);
    $document->setValue('contenido', '');
    $document->setValue('destino', $rs->nombre_destinatario);
    $document->setValue('cargo_destino', $rs->cargo_destinatario);
    $document->setValue('remite', $rs->nombre_remitente);
    $document->setValue('cargo', $rs->cargo_remitente);
    $document->setValue('copias', $rs->copias);
    $filetemp=time().'_'.$id.'.docx';
    $filename='temp/'.$filetemp;
    $document->save($filename);
    header ("Content-Disposition: attachment; filename=".$filetemp."\n\n");
    header ("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header ("Content-Length: ".filesize($filename));
    readfile($filename);
}
?>