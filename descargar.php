<?php
$id=$_GET['id'];
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=correspondencia', 'correspondencia', 'c0rr3sp0nd3nc14', array( PDO::ATTR_PERSISTENT => false));
$stmt = $dbh->prepare("SELECT * FROM archivos 
WHERE id='$id'");        
$stmt->execute();        
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {       
    $file='archivos/'.$rs->sub_directorio.'/'.$rs->nombre_archivo;  
    $filetemp=substr($rs->nombre_archivo,13);
    header ("Content-Disposition: attachment; filename=".$filetemp."\n\n");
    //header ("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header ("Content-Type: ".$rs->extension);
    header ("Content-Length: ".filesize($file));
    readfile($file);        
}
?>