<?php
include('db/dbclass.php');
$dbh=New db();
$nur=$_GET['nur'];

        $stmt = $dbh->prepare("SELECT c.logo FROM documentos AS a INNER JOIN oficinas AS b ON a.id_oficina = b.id
INNER JOIN entidades AS c ON b.id_entidad = c.id WHERE a.nur = '$nur'");
        $stmt->execute();
        //echo "<B>outputting...</B><BR>";
        $image_file = 'logo.jpg';
        while ($rs2 = $stmt->fetch(PDO::FETCH_OBJ)) {
            if ($rs2->logo) {
                $image_file = 'media/logos/' . $rs2->logo;
            }
        }

        
$stmt = $dbh->prepare("SELECT * FROM agrupaciones a INNER  JOIN nurs n ON a.padre=n.nur WHERE a.padre='$nur'");        
$stmt->execute();        
$padre =  $stmt->fetch(PDO::FETCH_OBJ);   
    require('libs/fpdf17/fpdf.php');
    require('libs/fpdf17/code39.php');
    $pdf = new PDF_Code39('P','mm','Letter');
    $pdf->AddPage();    
    $pdf->SetFont('Arial', '', 25);    
    $pdf->SetXY(30,20);
    $pdf->Cell(155, 10, 'CARATULA DE AGRUPACION', 1,FALSE,'C'); 
    $pdf->Ln();
   // $image_file = 'media/images/logo_MDPyEP.png';
    $pdf->Image($image_file, 85, 32, 43, 25, 'png', '', '', FALSE, 200, '', FALSE, FALSE, 1);
    $pdf->SetXY(30,30);
    $pdf->Cell(155, 25, '', 'LR',FALSE,'C'); 
    $pdf->Ln();
    $pdf->SetX(30);    
    $pdf->SetFont('Arial', '', 16);   
    $pdf->Cell(155, 10, $padre->nur, 'LR',FALSE,'C'); 
    $pdf->Ln();
    $pdf->Code39(80,65,$padre->nur,0.71,8);
    $pdf->Ln();
    $pdf->SetXY(30,65);    
    $pdf->Cell(155, 10, '', 'LRB',FALSE,'C'); 
    $pdf->Ln();
    $pdf->SetX(30);    
    $pdf->Cell(30, 10, 'AGRUPADO POR', 1,FALSE,'C'); 
    $pdf->Cell(125, 5, $padre->nombre, 'LR',FALSE,'L'); 
    $pdf->Ln();
    $pdf->SetX(60);    
    $pdf->Cell(125, 5, $padre->cargo, 'LRB',FALSE,'L'); 
    $pdf->Ln();
    $pdf->SetX(30);    
    $pdf->Cell(30, 10, 'FECHA', 1,FALSE,'L'); 
    $pdf->Cell(47, 10, date('d-m-Y',  strtotime($padre->fecha)), 1,FALSE,'L'); 
    $pdf->Cell(30, 10, 'HORA', 1,FALSE,'L'); 
    $pdf->Cell(48, 10, date('H:i:s',  strtotime($padre->fecha)), 1,FALSE,'L'); 
    
    $pdf->Ln(20);
    $pdf->SetX(20);
    $pdf->Cell(175, 10, 'HOJA(S) DE RUTA AGRUPADO(S)', 1,FALSE,'C'); 
    $pdf->Ln();
    $pdf->SetX(20);
    $pdf->SetFont('Arial', '', 7);   
    $pdf->SetFillColor(240,245,255);
    $pdf->Cell(25, 5, 'HOJA  RUTA', 1,FALSE,'C',TRUE); 
    $pdf->Cell(28, 5, 'F. CREACION', 1,FALSE,'C',TRUE); 
    $pdf->Cell(74, 5, 'CREADO POR', 1,FALSE,'C',TRUE);     
    $pdf->Cell(28, 5, 'F. RECEPCION', 1,FALSE,'C',TRUE);     
    $pdf->Cell(20, 5, 'OFICIAL', 1,FALSE,'C',TRUE); 
    
    //volmeos a ejecutar la consulta
    $stmt->execute(); 
    while($padre =  $stmt->fetch(PDO::FETCH_OBJ))
    {    
    $id=$padre->padre;
    $stmt = $dbh->prepare("
            SELECT * FROM seguimiento s 
            INNER JOIN nurs n ON s.nur=n.nur 
            INNER JOIN agrupaciones a ON s.id=a.id_seguimiento 
            WHERE a.padre='$nur'");        
    $stmt->execute();   
        while($hijo=$stmt->fetch(PDO::FETCH_OBJ))
        {            
            $pdf->Ln();
            $pdf->SetX(20);
            $pdf->Cell(25, 5, $hijo->nur, 1,FALSE,'C'); 
            $pdf->Cell(28, 5, date('d-m-Y',  strtotime($hijo->fecha_creacion)), 1,FALSE,'C'); 
            $pdf->Cell(74, 5, $hijo->username, 1,FALSE,'C');     
            $pdf->Cell(28, 5, date('d-m-Y',  strtotime($hijo->fecha_recepcion)), 1,FALSE,'C');                 
            if($hijo->oficial==1)
                    $oficial='SI';
            else
                $oficial='NO';
            $pdf->Cell(20, 5, $oficial, 1,FALSE,'C');             
        }    
    }
    $pdf->Ln(15);
    $pdf->SetX(20);
   // $txt='Nota: Verifique que que todas las hojas de urta las la documentoacion se encuentren presentes.';
    $txt='';
    $pdf->MultiCell(165, 10, $txt);
    
$pdf->Output();