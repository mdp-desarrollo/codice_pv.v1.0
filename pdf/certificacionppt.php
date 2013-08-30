<?php

require_once('../libs/tcpdf/config/lang/eng.php');
require_once('../libs/tcpdf/tcpdf.php');
require_once('../db/pyvdbclass.php');
$id = $_GET['id'];
$id_fucov = $_GET['f'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        $id = $_GET['id'];
        $dbh = New pyvdb();
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
        if($id_entidad<>2){
        $this->Image($image_file, 20, 7, 40, 23, 'PNG');
        }
        $this->SetFont('helvetica', 'B', 20);        
    }

    // Page footer
    public function Footer() {
        $id = $_GET['id'];
        $dbh = New pyvdb();
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
$pdf = new MYPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

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
try {/*
    $dbh = New db();
    $stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               WHERE d.id='$id'");
    // call the stored procedure
    $stmt->execute();
    //echo "<B>outputting...</B><BR>";
    //$pdf->Ln(7);
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Write(0, strtoupper($rs->tipo), '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Write(0, strtoupper($rs->codigo), '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B', 13);
        $pdf->Write(0, strtoupper($rs->nur), '', 0, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(15, 5, 'A:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Write(0, utf8_encode($rs->nombre_destinatario), '', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(15, 5, '');
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, utf8_encode($rs->cargo_destinatario), '', 0, 'L');
        $pdf->Ln(10);
        if (($rs->via != 0) && (trim($rs->nombre_via) != '')) {
            $pdf->SetFont('Helvetica', 'B', 10);
            $pdf->Cell(15, 5, 'Via:');
            $pdf->SetFont('Helvetica', '', 10);
            $pdf->Write(0, utf8_encode($rs->nombre_via), '', 0, 'L');
            $pdf->Ln();
            $pdf->Cell(15, 5, '');
            $pdf->SetFont('Helvetica', 'B', 10);
            $pdf->Write(0, utf8_encode($rs->cargo_via), '', 0, 'L');
            $pdf->Ln(10);
        }
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(15, 5, 'De:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Write(0, utf8_encode($rs->nombre_remitente), '', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(15, 5, '');
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, utf8_encode($rs->cargo_remitente), '', 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(15, 5, 'Fecha:');
        $pdf->SetFont('Helvetica', '', 10);
        $mes = (int) date('m', strtotime($rs->fecha_creacion));
        $meses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
        $fecha = date('d', strtotime($rs->fecha_creacion)) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime($rs->fecha_creacion));
        $pdf->Write(0, $fecha, '', 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(15, 5, 'Ref:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->MultiCell(170, 5, utf8_encode($rs->referencia), 0, 'L');
        $pdf->Ln(10);
        $pdf->writeHTML($rs->contenido);
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', '', 5);
        $pdf->writeHTML('cc. ' . strtoupper($rs->copias));
        $pdf->writeHTML('Adj. ' . strtoupper($rs->adjuntos));
        $pdf->writeHTML(strtoupper($rs->mosca_remitente));
        $nombre.='_' . substr($rs->cite_original, -10, 6);*/
    $dbh = New pyvdb();
    //FUCOV
    $stmt = $dbh->prepare("select * from pyvfucov where id = '$id_fucov'");
    $stmt->execute();    
    $fucov = $stmt->fetch(PDO::FETCH_OBJ) ;
    
    
    $stmt = $dbh->prepare("SELECT * FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id WHERE d.id='$fucov->id_documento'");
    $stmt->execute();    
    $rs = $stmt->fetch(PDO::FETCH_OBJ) ;
        
        //$pdf->SetFont('Helvetica', 'B', 15);
        //$pdf->Write(0, strtoupper($rs->tipo), '', 0, 'C');
        //$pdf->Ln();
        $pdf->SetFont('Helvetica', 'U', 12);
        $pdf->Write(0, 'CERTIFICACION PRESUPUESTARIA', '', 0, 'C');
        $pdf->Ln();
        $pdf->Write(0, 'GESTION '.date("Y", strtotime($rs->fecha_creacion)), '', 0, 'C');
        $pdf->Ln(10);
        
        $pdf->Write(0, 'ANTECEDENTES: ' ,'', 0, 'L');
        $pdf->Ln(10);

        $pdf->SetFont('Helvetica', '', 10);
        $antecedentes = "Mediante Hoja de Seguimiento $rs->nur, se remite el FUCOV $rs->codigo, del Sr(a). $fucov->nombre_user_comision,  $fucov->cargo_user_comision, solicitando viaticos por viaje a realizar a la ciudad de (localidad), con el objeto de: $rs->referencia.";
        $pdf->write(0, $antecedentes, '', 0, 'L');
        $pdf->Ln(10);
        
        $pdf->SetFont('Helvetica', 'U', 13);
        $pdf->write(0, 'ANALISIS Y/O VERIFICACION:', '', 0, 'L');
        $pdf->Ln(10);
        
        $pdf->SetFont('Helvetica', '', 10);
        $antecedentes = "Analizada la Presente Solicitud se CERTIFICA que existe el requirimiento de inscripcion en el Presupuesto de la Gestion ".date("Y", strtotime($rs->fecha_creacion))." para llevar adelante esta actividad, con cargo a:";
        $pdf->write(0, $antecedentes, '', 0, 'L');
        $pdf->Ln(10);
        
        $pdf->SetFont('Helvetica', 'U', 11);
        $pdf->write(0, 'ESTRUCTURA PROGRAMATICA', '', 0, 'L');
        $pdf->Ln(10);
        //obtener el id para la estructura programatica, donde se gurada la informacion presupuetaria
        $stmt = $dbh->prepare("select * from pyvliquidacion where id_fucov = '$fucov->id'");
        $stmt->execute();    
        $liq = $stmt->fetch(PDO::FETCH_OBJ) ;
        
         $stmt = $dbh->prepare("select p.id, p.gestion, p.codigo_entidad, p.entidad,
da.codigo_da, of2.oficina da,
ue.codigo_ue, of1.oficina ue,
prog.codigo codigo_prog, prog.programa,
proy.codigo codigo_proy, proy.proyecto,
act.codigo codigo_act, act.actividad,
fte.codigo codigo_fte, fte.denominacion fuente,
org.codigo codigo_org, org.denominacion organismo
from pyvprogramatica p inner join pyvunidadfuncional da on p.id_da = da.id inner join oficinas of2 on da.id_oficina = of2.id
inner join pyvunidadfuncional ue on p.id_ue = ue.id inner join oficinas of1 on ue.id_oficina = of1.id
inner join pyvprograma prog on p.id_programa = prog.id
inner join pyvproyecto proy on p.id_proyecto = proy.id 
inner join pyvactividadppt act on p.id_actividadppt = act.id
inner join pyvfuente fte on p.id_fuente = fte.id
inner join pyvorganismo org on p.id_organismo = org.id
where p.id = $liq->id_programatica");
    $stmt->execute();
    $ppt = $stmt->fetch(PDO::FETCH_OBJ) ;
    ///se imprime proyecto o actividad pero no ambos
    if($ppt->codigo_proy != '0000')
        $proyact = "<tr>
                <td>ACTIVIDAD</td>
                <td>:$ppt->codigo_proy</td>
                <td>$ppt->proyecto</td>
            </tr>";
    else
        $proyact = "<tr>
                <td>ACTIVIDAD</td>
                <td>:$ppt->codigo_act</td>
                <td>$ppt->actividad</td>
            </tr>";
    $pdf->SetFont('Helvetica', '', 10);
    $html = "
        <table style=\" width: 100%;\"  border=\"0px\">
            <tr>
                <td style = \" width: 30%;\">ENTIDAD</td>
                <td style = \" width: 5%;\">:$ppt->codigo_entidad</td>
                <td style = \" width: 65%;\">$ppt->entidad</td>
            </tr>
            <tr>
                <td>DIRECCION ADMINISTRATIVA</td>
                <td>:$ppt->codigo_da</td>
                <td>$ppt->da</td>
            </tr>
            <tr>
                <td>UNIDAD EJECUTORA</td>
                <td>:$ppt->codigo_ue</td>
                <td>$ppt->ue</td>
            </tr>
            <tr>
                <td>PROGRAMA</td>
                <td>:$ppt->codigo_prog</td>
                <td>$ppt->programa</td>
            </tr>".$proyact."            
            <tr>
                <td>FUENTE DE FINANCIAMIENTO</td>
                <td>:$ppt->codigo_fte</td>
                <td>$ppt->fuente</td>
            </tr>
            <tr>
                <td>ORGANISMO FINANCIADOR</td>
                <td>:$ppt->codigo_org</td>
                <td>$ppt->organismo</td>
            </tr>
        </table>";
        $pdf->writeHTML($html, false, false, false);
        $stmt = $dbh->prepare("select * from pyvliquidacionpartida where id_liquidacion = $liq->id");
        $stmt->execute();
        $html = "<table border=\"1px\">
                    <tr>
                        <td style = \" width: 10%;\">Partida</td>
                        <td style = \" width: 40%;\">Descripci&oacute;n</td>
                        <td style = \" width: 20%;\">Saldo Disponible</td>
                        <td style = \" width: 20%;\">Importe Certificado</td>
                        <td style = \" width: 10%;\">Saldo Actual</td>
                    </tr>";
        while ($ppt = $stmt->fetch(PDO::FETCH_OBJ)) {
                $total = $ppt->cs_saldo_devengado - $ppt->importe_certificado;
                $html = $html."<tr><td>$ppt->cod_partida</td><td>$ppt->partida</td><td>$ppt->cs_saldo_devengado</td>
                        <td>$ppt->importe_certificado</td><td>$total</td>
                        </tr>";
        }
        $html = $html."</table>";
        //$pdf->Ln(10);
        $pdf->writeHTML($html, false, false, false);
        //$pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'U', 12);        
        $pdf->Write(0, 'CONCLUSION:', '', 0, 'L');
        $pdf->SetFont('Helvetica', '', 9);
        $html = "&Eacute;ste certificado solo refrenda y verifica la existencia de saldos presupuestarios. En este sentido, se hace notar que la verificaci&oacute;
        de dicha actividad est&eacute; incorporada en el Programa Operativo Anual Gesti&oacute;n".date("Y", strtotime($rs->fecha_creacion)).", es de plena responsabilidad de la 
        Unidad Solicitante, as&iacute; como la tramitaci&oacute;n de la cuota de devengamiento correspondiente.
        <br />Es Cuanto se certifica para fines consiguientes.
        <br />La Paz, ".date("d-m-Y").".";
        $pdf->Ln(10);
        $pdf->writeHTML($html, false, false, false);
        
     /*  
    //unidad ejecutora
    $stmt = $dbh->prepare("select o.oficina unidad from pyvunidadfuncional u inner join oficinas o on u.id_oficina = o.id where u.id = '$fc->id_unidad_ejecutora'");
    $stmt->execute();    
    $ue = $stmt->fetch(PDO::FETCH_OBJ) ;
    
    //$pdf->SetFont('Helvetica', 'B', 13);
    $pdf->Write(0, '________________________________________________________________________________', '', 0, 'C');
    $pdf->Ln(10);
    $pdf->Write(0, 'Unidad Ejecutora: ' .$ue->unidad, '', 0, 'L');
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', 'B', 13);
    $pdf->Write(0, 'ESTRUCTURA PRESUPUESTARIA', '', 0, 'C');
    $pdf->Ln();
    
    //$stmt = $dbh->prepare("select * from pyvestructuraprogramatica where id_unidad_funcional = '$fc->id_unidad_ejecutora'");
    //$stmt->execute();    
    //$pre = $stmt->fetch(PDO::FETCH_OBJ) ;
    $pdf->SetFont('Helvetica', '', 8);
    $pdf->Write(0, 'ENTIDAD: '.$pre->desc_entidad, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'DIRECCION ADMINISTRATIVA:'.$pre->desc_da, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'UNIDAD EJECUTORA:'.$pre->desc_ue_ppt, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'PROGRAMA:'.$pre->programa, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'PROYECTO:'.$pre->proyecto, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'ACTIVIDAD:'.$pre->actividad, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'FUENTE:'.$pre->desc_fuente, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'ORGANISMO:'.$pre->desc_organismo, '', 0, 'L');
    $pdf->Ln();
    $pdf->Write(0, 'GESTION:'.$pre->gestion, '', 0, 'L');
    $pdf->Ln(10);

    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->Write(0, 'RESUMEN DE LA EJECUCION PRESUPUESTARIA', '', 0, 'C');    
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->Write(0, 'PARTIDA PRESUPUESTARIA - PRESUPUESTO DISPONIBLE - PRESUPUESTO REQUERIDO - NUEVO SALDO PRESUPUESTO', '', 0, 'L');
    $pdf->Ln(10);
    $stmt = $dbh->prepare("select * from pyvestructuraprogramatica where id_unidad_funcional = '$fc->id_unidad_ejecutora'");
    $stmt->execute();

    while ($t = $stmt->fetch(PDO::FETCH_OBJ)) {
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Write(0, $t->desc_partida.' - '.$t->ppto_vigente.' - ', '', 0, 'L');
        $pdf->Ln();
    }

    $nombre.='_' . substr($rs->cite_original, -10, 6);
    $c = 'asdasdasd';        
    $html = "<table style=\" width: 100%;\"  border=\"1px\"><tr><td>$c</td></tr><tr><td>123</td></tr></table>";
    
    $pdf->writeHTML($html,true,true, true);*/  
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Close and output PDF document
$pdf->Output($nombre . '.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
