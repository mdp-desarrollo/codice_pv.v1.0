<?php

require_once('../libs/tcpdf/config/lang/eng.php');
require_once('../libs/tcpdf/tcpdf.php');
require_once('../db/dbclass.php');
$id = $_GET['id'];
$id_fucov = $_GET['f'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    
    //Page header
    public function Header() {
        
        
        
        $id = $_GET['id'];
        $dbh = New db();
        $stmt = $dbh->prepare("SELECT c.logo,c.id FROM documentos AS a INNER JOIN oficinas AS b ON a.id_oficina = b.id
INNER JOIN entidades AS c ON b.id_entidad = c.id WHERE a.id = '$id'");
        $stmt->execute();
        //echo "<B>outputting...</B><BR>";
        $image_file = 'logo.jpg';
        while ($rs2 = $stmt->fetch(PDO::FETCH_OBJ)) {
            if ($rs2->logo) {
                $image_file = '../media/logos/' . $rs2->logo;
            }
            $id_entidad=$rs2->id;
        }
        if($id_entidad<>2 && $id_entidad<>4){
        $this->Image($image_file, 89, 5, 40, 23, 'PNG');
        }
        $this->SetFont('helvetica', 'B', 20);        
    }

    // Page footer
    public function Footer() {
        $id = $_GET['id'];
        $dbh = New db();
        $stmt = $dbh->prepare("SELECT e.pie_1,e.pie_2,e.id FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               INNER JOIN oficinas o ON d.id_oficina=o.id
                               INNER JOIN entidades e ON o.id_entidad=e.id
                               WHERE d.id='$id'");
        $stmt->execute();
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $pie1 = $rs->pie_1;
            $pie2 = $rs->pie_2;
            $id_entidad=$rs->id;
        }
        if($id_entidad<>2){
        // Linea vertical negra
            
        $style = array('width' => 1.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));
        $this->Line(140, 257, 140, 272, $style);
        // logo quinua
        $this->Image('../media/logos/logo_quinua.jpg', 140, 253, 40, 22, 'JPG');
        // Pie de pagina
        $this->SetFont('helvetica', 'I', 7);
        $this->MultiCell(85, 0, $pie1, 0, 'R', false, 1, 50, 260, true, 0, false, true, 0, 'T', false);
        $this->MultiCell(90, 0, $pie2, 0, 'R', false, 1, 45, 266, true, 0, false, true, 0, 'T', false);
        $this->SetY(30);
        }
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
//$pdf = new MYPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('DOCUMENTO');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(20, 33, 20);
//$pdf->SetMargins(20, PDF_MARGIN_TOP, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

$pdf->SetFont('Helvetica', 'B', 18);

// add a page
$pdf->AddPage();
$nombre = 'cert_ppto';
try {
    $dbh = New db();
    //FUCOV
    $stmt = $dbh->prepare("select * from pvfucovs where id = '$id_fucov'");
    $stmt->execute();    
    $fucov = $stmt->fetch(PDO::FETCH_OBJ) ;
    
    $stmt = $dbh->prepare("SELECT * FROM documentos WHERE id='$fucov->id_documento'");
    $stmt->execute();
    $doc = $stmt->fetch(PDO::FETCH_OBJ);

    $stmt = $dbh->prepare("select ofi.id id_oficina, ofi.oficina, ofi.sigla sigla_oficina, ofi.ppt_unid_ejecutora ue, ofi.ppt_da da, ent.id id_entidad, ent.entidad, ent.sigla sigla_entidad
from oficinas ofi inner join entidades ent on ofi.id_entidad = ent.id
where ofi.id = '$doc->id_oficina'");
    $stmt->execute();
    $ofi = $stmt->fetch(PDO::FETCH_OBJ);///oficina y entidad solicitante
    
    $stmt = $dbh->prepare("select oficina, ppt_cod_da from oficinas where id_entidad = '$ofi->id_entidad' and ppt_da = 1");//Direccion administrativa
    $stmt->execute();
    $da = $stmt->fetch(PDO::FETCH_OBJ) ;
    ///Unidad Ejecutora Presupuesto
    $stmt = $dbh->prepare("SELECT * FROM oficinas WHERE id=$ofi->id_oficina");
    $stmt->execute();
    $ue = $stmt->fetch(PDO::FETCH_OBJ);
    while($ue->ppt_unid_ejecutora == NULL || $ue->ppt_unid_ejecutora == 0){
        $stmt = $dbh->prepare("SELECT * FROM oficinas WHERE id=$ue->padre");
        $stmt->execute();
        $ue = $stmt->fetch(PDO::FETCH_OBJ);
    }
    $color = "#CBCBCB";
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->write(0,'CERTIFICACIÓN PRESUPUESTARIA '.date("Y", strtotime($doc->fecha_creacion)),'',0,'C');
        
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 13);
        $pdf->write(0,$doc->nur,'',0,'C');
        
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'U', 12);
        $pdf->Write(0, 'ANTECEDENTES: ' ,'', 0, 'L');
        $pdf->Ln(10);

        $pdf->SetFont('Helvetica', '', 10);
        $antecedentes = "<p style=\"text-align: justify;\">Mediante Hoja de Seguimiento $doc->nur, se remite el FUCOV $doc->codigo, del Sr(a). $doc->nombre_remitente,  $doc->cargo_remitente, solicitando viaticos por viaje a realizar a la ciudad de $fucov->destino, con el objeto de: $doc->referencia.</p>";
        //$pdf->write(0, $antecedentes, '', 0, 'L');
        $pdf->writeHTML(utf8_encode($antecedentes), false, false, false);
        $pdf->Ln(10);
        
        $pdf->SetFont('Helvetica', 'U', 12);
        $pdf->write(0, 'ANALISIS Y/O VERIFICACION:', '', 0, 'L');
        $pdf->Ln(10);
        
        $pdf->SetFont('Helvetica', '', 10);
        $antecedentes = "<p style=\"text-align: justify;\">Analizada la Presente Solicitud se CERTIFICA que existe el requerimiento de inscripción en el Presupuesto de la Gestión ".date("Y", strtotime($doc->fecha_creacion))." para llevar adelante esta actividad, con cargo a:</p>";
        $pdf->writeHTML($antecedentes, false, false, false);
        $pdf->Ln(10);
        
        $pdf->SetFont('Helvetica', 'U', 12);
        $pdf->write(0, 'ESTRUCTURA PROGRAMATICA', '', 0, 'L');
        $pdf->Ln(10);
        $stmt = $dbh->prepare("select prog.codigo cod_programa, prog.programa programa, proy.codigo cod_proyecto, proy.proyecto proyecto, act.codigo cod_actividad, act.actividad actividad, fte.codigo cod_fuente, 
fte.denominacion fuente, org.codigo cod_organismo, org.denominacion organismo
from pvprogramaticas p 
inner join pvprogramas prog on p.id_programa = prog.id
inner join pvproyectos proy on p.id_proyecto = proy.id
inner join pvpptactividades act on p.id_actividadppt = act.id
inner join pvorganismos org on p.id_organismo = org.id
inner join pvfuentes fte on p.id_fuente = fte.id
where p.id = $fucov->id_programatica");
    $stmt->execute();
    $ppt = $stmt->fetch(PDO::FETCH_OBJ) ;
    ///se imprime proyecto o actividad pero no ambos
    if($ppt->cod_proyecto != '0000')
        $proyact = "
            <tr>
                <td>ACTIVIDAD</td>
                <td>:$ppt->cod_proyecto</td>
                <td>$ppt->proyecto</td>
            </tr>";
    else
        $proyact = "
            <tr>
                <td>ACTIVIDAD</td>
                <td>:$ppt->cod_actividad</td>
                <td>$ppt->actividad</td>
            </tr>";
    $pdf->SetFont('Helvetica', '', 8);
    $html = "
        <table style=\" width: 100%;\"  border=\"0px\" cellpadding=\"1\">
            <tr>
                <td style = \" width: 30%;\">ENTIDAD</td>
                <td style = \" width: 10%;\">:$ofi->sigla_entidad</td>
                <td style = \" width: 60%;\">$ofi->entidad</td>
            </tr>
            <tr>
                <td>DIRECCION ADMINISTRATIVA</td>
                <td>:$da->ppt_cod_da</td>
                <td>$da->oficina</td>
            </tr>
            <tr>
                <td>UNIDAD EJECUTORA</td>
                <td>:$ue->ppt_cod_ue</td>
                <td>$ue->oficina</td>
            </tr>
            <tr>
                <td>PROGRAMA</td>
                <td>:$ppt->cod_programa</td>
                <td>$ppt->programa</td>
            </tr>".$proyact."
            <tr>
                <td>FUENTE DE FINANCIAMIENTO</td>
                <td>:$ppt->cod_fuente</td>
                <td>$ppt->fuente</td>
            </tr>
            <tr>
                <td>ORGANISMO FINANCIADOR</td>
                <td>:$ppt->cod_organismo</td>
                <td>$ppt->organismo</td>
            </tr>
        </table>";
        $pdf->writeHTML(utf8_encode($html), false, false, false);
        $pdf->Ln(5);
        $stmt = $dbh->prepare("select * from pvliquidaciones where id_fucov = $fucov->id");
        $stmt->execute();
        $html = "<table border=\"1px\" cellpadding=\"3\">
                    <tr>
                        <td style = \" width: 10%;\" bgcolor=\"$color\">Partida</td>
                        <td style = \" width: 40%;\" bgcolor=\"$color\">Descripci&oacute;n</td>
                        <td style = \" width: 20%;\" bgcolor=\"$color\">Saldo Disponible</td>
                        <td style = \" width: 20%;\" bgcolor=\"$color\">Importe Certificado</td>
                        <td style = \" width: 10%;\" bgcolor=\"$color\">Saldo Actual</td>
                    </tr>";
        $c = 0;
        while ($ppt = $stmt->fetch(PDO::FETCH_OBJ)) {
                $total = $ppt->cs_saldo_devengado - $ppt->importe_certificado;
                $html = $html."<tr><td>$ppt->cod_partida</td><td>$ppt->partida</td><td>$ppt->cs_saldo_devengado</td>
                        <td>$ppt->importe_certificado</td><td>$total</td>
                        </tr>";
                $c++;
        }
        $html = $html."</table>";
        $pdf->writeHTML($html, false, false, false);
        if ($c == 0){
            $pdf->Ln(3);
            $pdf->SetFont('Helvetica', 'B', 12);        
            $pdf->Write(0, 'El Presupuesto No Fue Autorizado', '', 0, 'C');
            $pdf->Ln(10);
        }
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica', 'U', 12);
        $pdf->Write(0, 'CONCLUSION:', '', 0, 'L');
        $pdf->SetFont('Helvetica', '', 10);
        $mes = (int) date('m', strtotime(date("d-m-Y")));
        $meses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
        $fecha_certificacion = date('d', strtotime(date("d-m-Y"))) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime(date("d-m-Y")));
        $html = "<p style=\"text-align: justify;\">&Eacute;ste certificado s&oacute;lo refrenda y verifica la existencia de saldos presupuestarios. En este sentido, se hace notar que la verificaci&oacute;n
        de dicha actividad est&eacute; incorporada en el Programa Operativo Anual Gesti&oacute;n ".date("Y", strtotime($doc->fecha_creacion)).", es de plena responsabilidad de la 
        Unidad Solicitante, as&iacute; como la tramitaci&oacute;n de la cuota de devengamiento correspondiente.
        <br />Es Cuanto se certifica para fines consiguientes.</p>
        <br /><br />La Paz, ".$fecha_certificacion.".";
        $pdf->Ln(10);
        $pdf->writeHTML($html, false, false, false);
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Close and output PDF document
$pdf->Output($nombre . '.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
