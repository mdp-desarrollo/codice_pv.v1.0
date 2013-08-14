<?php
include('word/dbclass.php');
$dbh=New db();
$id=$_GET['id'];
$p=$_GET['p'];
$stmt = $dbh->prepare("SELECT s.id, n.nur,d.codigo,d.referencia,s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision,s.proveido FROM seguimiento s
            INNER JOIN nurs n ON s.nur=n.nur
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN documentos d ON d.nur=s.nur
            WHERE s.id='$id'
            and d.original='1'");        
$stmt->execute();        
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {   
    require('libs/fpdf17/fpdf.php');    
    //$pdf = new FPDF('P','mm','Letter');
    
    #Creamos el objeto pdf (con medidas en milímetros):
$pdf = new FPDF('P', 'mm', 'Letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(10, 20 , 10);
#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(FALSE,10);  
    
    
    
    $pdf->AddPage();    
     $p=($p*42)+10;
     $pdf->SetFont('Arial', 'B', 11);   
     $pdf->SetY($p); 
     $pdf->Cell(45, 15, $rs->nur,'LTR',0,'C');  
     $pdf->ln();
     $pdf->SetFont('Arial', '', 8); 
     $fecha=date('d-m-Y H:i:s',  strtotime($rs->fecha_emision));
     $pdf->Cell(45, 10, $fecha,'LR',0,'C');
     $pdf->ln();     
     $pdf->SetFont('Arial', '', 8); 
     $pdf->Cell(45, 10, '','LBR',0,'C');
     $pdf->SetXY(55,$p);
     if(strlen($rs->proveido)>80){
         $pdf->MultiCell(115, 8, 'Proveido: '. $rs->proveido,1,'L',0,1,'','',TRUE);
     }else{
         $pdf->Cell(115, 15, 'Proveido: '. $rs->proveido,1,1,'L');
     }
     
     $pdf->SetXY(55,$p+15);
     $pdf->MultiCell(115, 20, 'Derivado a: ',0,'L');
     
     $pdf->SetXY(55,$p+18);
     $pdf->Cell(115, 5, $rs->a_oficina,'LR',0,'C');  
     $pdf->SetXY(55,$p+24);
     $pdf->SetFont('Arial', '', 8); 
     $pdf->Cell(115, 5, $rs->nombre_receptor,'LR',0,'C');
     $pdf->SetXY(55,$p+30);
     $pdf->SetFont('Arial', '', 6); 
     $pdf->Cell(115, 5, $rs->cargo_receptor,'LBR',0,'C');
     
//     $pdf->SetXY(45,$p+17);
//     $pdf->MultiCell(120, 18, 'Derivado a: ',1,'L');
//     $pdf->SetY($p); 
//     $pdf->Cell(170, $p+30, $rs->a_oficina,'',0,'C');  
     
//     $pdf->SetXY(45,$p+17);
//     $pdf->Cell(50, 5, $rs->a_oficina,'LR',0,'C');
//     $pdf->SetXY(115,$p+20);
//     $pdf->Cell(50, 5, $rs->nombre_receptor,'LR',0,'C');
//     $pdf->SetXY(115,$p+25);
//     $pdf->Cell(50, 5, $rs->cargo_receptor,'LR',0,'C');

//     $pdf->SetXY(115,$p);     
////     $pdf->SetFont('Arial', '', 10); 
////     $pdf->Cell(50, 10, 'Derivado a',1,0,'C');
//     $pdf->SetXY(115,$p+10);
//     $pdf->SetFont('Arial', '', 8); 
//     $pdf->Cell(50, 5, '','LR',0,'C');
//     $pdf->SetXY(115,$p+15);
//     $pdf->Cell(50, 5, $rs->a_oficina,'LR',0,'C');
//     $pdf->SetXY(115,$p+20);
//     $pdf->Cell(50, 5, $rs->nombre_receptor,'LR',0,'C');
//     $pdf->SetXY(115,$p+25);
//     $pdf->Cell(50, 5, $rs->cargo_receptor,'LR',0,'C');
     //$pdf->SetXY(115,$p+30);
     //$pdf->Cell(50, 5, '','LBR',0,'C');
     
     $pdf->SetXY(170,$p);
     $pdf->Cell(40, 35, '',1,0,'C');
$pdf->Output();
//$pdf->Output('derivacion' . '.pdf', 'I');
}
