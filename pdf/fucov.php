<?php

require_once('../libs/tcpdf/config/lang/eng.php');
require_once('../libs/tcpdf/tcpdf.php');
require_once('../db/dbclass.php');
$id = $_GET['id'];

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {

        // codigo de freddy
        // dir logos /codice/media/logos/
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
            $id_entidad = $rs2->id;
        }
        if ($id_entidad <> 2 && $id_entidad <> 4) {
            $this->Image($image_file, 89, 5, 40, 23, 'PNG');
        }
        $this->SetFont('helvetica', 'B', 20);
        //$this->Ln(120);
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
            $id_entidad = $rs->id;
        }
        if ($id_entidad <> 2 && $id_entidad <> 4) {
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

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('DOCUMENTO');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$dbh = New db();
$sql = "SELECT d.id_entidad FROM documentos d WHERE d.id='$id'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
    $id_entidad = $rs->id_entidad;
}
$margin_top = 33;
if ($id_entidad == 2) {
    $margin_top = 33;
} elseif ($id_entidad == 4) {
    $margin_top = 60;
}

//set margins
$pdf->SetMargins(20, $margin_top, 20);
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
$nombre = 'fucov';
try {
    $dbh = New db();
    $stmtp = $dbh->prepare("SELECT *,t.tipo,t.via FROM documentos d, pvfucovs p, tipos t WHERE d.id='$id' AND d.id=p.id_documento AND d.id_tipo=t.id");
    // call the stored procedure
    $stmtp->execute();
    //echo "<B>outputting...</B><BR>";
    //$pdf->Ln(7);
    while ($rs = $stmtp->fetch(PDO::FETCH_OBJ)) {
        ///MEMO
        $stmtp = $dbh->prepare("select d.fecha_creacion, o.oficina from documentos d inner join oficinas o on d.id_oficina = o.id where d.id = $rs->id_memo ");
        $stmtp->execute();
        $memo = $stmtp->fetch(PDO::FETCH_OBJ);
        ///CATEGORIA DE VIAJE
        $stmtp = $dbh->prepare("select * from pvcategorias where id = $rs->id_categoria ");
        $stmtp->execute();
        $cat = $stmtp->fetch(PDO::FETCH_OBJ);
        if($cat)
            $categoria = $cat->categoria;
        else
            $categoria = "<b>NO SELECCIONADO</b>";
        ///TIPO DE VIAJE
        $stmtp = $dbh->prepare("select * from pvtipoviajes where id = $rs->id_tipoviaje ");
        $stmtp->execute();
        $viaje = $stmtp->fetch(PDO::FETCH_OBJ);
        if($viaje)
            $tipoviaje = $viaje->tipoviaje;
        else
            $tipoviaje = '<b>NO SELECCIONADO</b>';
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Write(0, 'FORMULARIO UNICO DE COMISION DE VIAJE ('.strtoupper($rs->tipo).')', '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Write(0, strtoupper($rs->codigo), '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B', 13);
        $pdf->Write(0, strtoupper($rs->nur), '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B', 8);
        //$pdf->Ln();
        $marca = '#DADADA';
        $padding = 2;
        $contenido='<table border="1" cellpadding="'.$padding.'">
                    <tr style="text-align:left;background-color: #F4F4F4;">
                        <td colspan="2"><b>PARTE I. DECLARATORIA EN COMISION</b></td>
                    </tr>
                    <tr>
                        <td width="35%">NOMBRES Y APELLIDOS DEL SERVIDOR PUBLICO</td>
                        <td width="65%">'.$rs->nombre_remitente.'</td>
                    </tr>
                    <tr>
                        <td>CARGO</td>
                        <td>'.$rs->cargo_remitente.'</td>
                    </tr>
                    <tr>
                        <td>PROPOSITO DEL VIAJE</td>
                        <td>'.$rs->referencia.'</td>
                    </tr>
                    <tr>
                        <td>FECHA DE DECLARACION EN COMISION</td>
                        <td>'.$rs->fecha_creacion.'</td>
                    </tr>
                    <tr>
                        <td ><span style="color:#DADADA; text-align:center; font-size: 80%;"><br /><br /><br /><br /><br />SELLO</span></td>
                        <td><span style="color:#DADADA; text-align:center; font-size: 80%;"><br /><br /><br /><br /><br />FIRMA</span></td>
                    </tr>
                    <tr style="text-align:left;background-color: #F4F4F4;">
                        <td colspan="2"><b>PARTE II. IDENTIFICACION DEL AREA QUE AUTORIZA EL VIAJE</b></td>
                    </tr>
                    <tr>
                        <td>DIRECCION/UNIDAD</td>
                        <td>'.$memo->oficina.'</td>
                    </tr>
                    <tr>
                        <td>NOMBRE DE QUIEN AUTORIZA EL VIAJE</td>
                        <td>'.$rs->nombre_destinatario.'</td>
                    </tr>
                    <tr>
                        <td>CARGO</td>
                        <td>'.$rs->cargo_destinatario.'</td>
                    </tr>
                    <tr>
                        <td>FECHA DE AUTORIZACION DE VIAJE</td>
                        <td>'.$memo->fecha_creacion.'</td>
                    </tr>
                    <tr>
                        <td ><span style="color:#DADADA; text-align:center; font-size: 80%;"><br /><br /><br /><br /><br />SELLO</span></td>
                        <td><span style="color:#DADADA; text-align:center; font-size: 80%;"><br /><br /><br /><br /><br />FIRMA</span></td>
                    </tr>
                    <tr style="text-align:left;background-color: #F4F4F4;">
                        <td colspan="2"><b>PARTE III. SOLICITUD DE PASAJES Y VIATICOS</b></td>
                    </tr>
                </table>';
//        $pdf->writeHTML(utf8_decode($parte1), false, false, false);
        /*
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(50, 5, 'Autoriza el Viaje:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Write(0, utf8_encode($rs->nombre_destinatario), '', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(50, 5, '');
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
        $pdf->Cell(50, 5, 'Funcionario en Comisión:');
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Write(0, utf8_encode($rs->nombre_remitente), '', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(50, 5, '');
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, utf8_encode($rs->cargo_remitente), '', 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(50, 5, 'Fecha Creación:');
        $pdf->SetFont('Helvetica', '', 10);
        $mes = (int) date('m', strtotime($rs->fecha_creacion));
        $meses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
        $fecha = date('d', strtotime($rs->fecha_creacion)) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime($rs->fecha_creacion));
        $pdf->Write(0, $fecha, '', 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(50, 5, 'Motivo:');

        $pdf->SetFont('Helvetica', '', 10);
        $pdf->MultiCell(170, 5, utf8_encode($rs->referencia), 0, 'L');
        $pdf->Ln(10);
*/
        function dia_literal($n) {
            switch ($n) {
                case 1: return 'Lun';
                    break;
                case 2: return 'Mar';
                    break;
                case 3: return 'Mie';
                    break;
                case 4: return 'Jue';
                    break;
                case 5: return 'Vie';
                    break;
                case 6: return 'Sab';
                    break;
                case 0: return 'Dom';
                    break;
            }
        }

        $fi = date('Y-m-d', strtotime($rs->fecha_salida));
        $ff = date('Y-m-d', strtotime($rs->fecha_arribo));
        $hi = date('H:i:s', strtotime($rs->fecha_salida));
        $hf = date('H:i:s', strtotime($rs->fecha_arribo));
        $diai = dia_literal(date("w", strtotime($fi)));
        $diaf = dia_literal(date("w", strtotime($ff)));

        if ($rs->cancelar == 'Hospedaje y alimentacion' || $rs->cancelar == 'Hospedaje') {
            $cancelar = "<b>Financiado por:</b>" . $rs->financiador . "<br> * " . $rs->cancelar;
        } else {
            $cancelar = "* " . $rs->cancelar;
        }
        
        $tipo_moneda="Bs.";
        if($rs->tipo_moneda==1){
            $tipo_moneda='$us.';
        }

        ///numero de dias
        $fecha1 = strtotime($fi);
        $fecha2 = strtotime($ff);
        $diff =  $fecha2 - $fecha1;
        if($diff < 0)
            $diff = $diff*(-1);
        if ($diff==0)
            $dias = 1;
        else{
            $dias = intval((($diff) / (60*60*24)));
            if (strcasecmp($hf, '12:00:00') != 0) {
                if(strcasecmp($hf, '12:00:00') > 0)
                    $dias ++;
            }
        }
        
        $contenido .= ' <table border="1" cellpadding="'.$padding.'" width="100%">
                            <thead>
                                <tr style="text-align:center;background-color: #666666;color: #FFFFFF;">
                                    <th width="100">Origen</th>
                                    <th width="100">Destino</th>
                                    <th width="88">Fecha y Hora <br>Salida</th>
                                    <th width="88">Fecha y Hora <br>Retorno</th>
                                    <th >Transporte</th>
                                    <th width="91.2">Viaticos</th>
                                    <th width="39">Desc. IVA</th> 
                                    <th width="39">Gasto<br>Rep.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align:center;">
                                    <td width="100">' . $rs->origen . '</td>
                                    <td width="100">' . $rs->destino . '</td>
                                    <td width="88">' . $diai . ' ' . $fi . '<br>' . $hi . '</td>
                                    <td width="88">' . $diaf . ' ' . $ff . '<br>' . $hf . '</td>
                                    <td >' . $rs->transporte . '</td>
                                    <td width="91.2" style="text-align:left;">' . $cancelar . '</td>
                                    <td width="39" >' . $rs->impuesto . '</td>
                                    <td width="39">' . $rs->representacion . '</td>
                                </tr>
                                <tr>
                                    <td colspan="8"></td>
                                </tr>
                            </tbody>
                        </table>';
       $contenido .='  <table border="1" cellpadding="'.$padding.'">
                            <tr>
                                <td width="15%">TIPO VIAJE</td>
                                <td width="85%">'.$tipoviaje.'</td>
                            </tr>
                            <tr>
                                <td width="15%">CATEGORIA</td>
                                <td width="85%">'.$categoria.'</td>
                            </tr>
                        </table>';
        
        $contenido .='<table border="1" width="100%" cellpadding="'.$padding.'">
                        <tr  style="text-align:center;background-color: #666666;color: #FFFFFF;">
                            <td>Nro Dias</td>
                            <td>% Vi&aacute;tico</td>
                            <td>Viatico x Dia</td>
                            <td>Total Vi&aacute;ticos</td>
                            <td>Desc. IVA <br />13 %</td>
                            <td>Gasto Rep.</td>
                            <td>Cambio</td>
                            <td>Total Pasajes</td>
                        </tr>
                        <tr style="text-align:center;">
                            <td>'.$dias.'</td>
                            <td>'.$rs->porcentaje_viatico.'</td>
                            <td>'.$rs->viatico_dia. ' '.$tipo_moneda.'</td>
                            <td>'.$rs->total_viatico. ' '.$tipo_moneda.'</td>
                            <td>'.$rs->gasto_imp. ' '.$tipo_moneda.'</td>
                            <td>'.$rs->gasto_representacion. ' '.$tipo_moneda.'</td>
                            <td>'.$rs->tipo_cambio.'</td>
                            <td>'.$rs->total_pasaje.'</td>
                        </tr></table>';
        if ($rs->justificacion_finsem != '')
            $contenido .='<table border="1" cellpadding="'.$padding.'">
                            <tr><td colspan = "2"></td></tr>
                            <tr>
                                <td width="35%">JUSTIFICACION DE VIAJE EN FIN DE SEMANA O FERIADO</td>
                                <td width="65%">'.$rs->justificacion_finsem.'</td>
                            </tr>
                          </table>';

        /*$contenido .= '
            <br><br>
<table width="100%">                        
                        <tr>
                            <td colspan="3" style="padding-left: 5px;"><b>% Viaticos: </b>' . $rs->porcentaje_viatico . ' %</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding-left: 5px;"><b>Viatico x Dia:</b> ' . $rs->viatico_dia . ' '.$tipo_moneda.'</td>
                        </tr>     
                        <tr>
                            <td colspan="3" style="padding-left: 5px;"><b>Descuento IVA 13 %:</b> ' . $rs->gasto_imp . ' '.$tipo_moneda.'</td>
                        </tr> 
                        <tr>    
                            <td><b>TOTAL VIATICOS:</b> ' . $rs->total_viatico . '  '.$tipo_moneda.'</td>
                            <td width="250"><b>GASTOS DE REPRESENTACIÓN:</b> ' . $rs->gasto_representacion . ' '.$tipo_moneda.'</td>    
                            <td><b>TOTAL PASAJES:</b> ' . $rs->total_pasaje . '  '.$tipo_moneda.'</td>
                        </tr><br>';
        if ($rs->justificacion_finsem != '')
            $contenido .='<tr><td colspan="2" style="padding-left: 5px;"><b>Justificacion Fin de Semana:</b><br>' . $rs->justificacion_finsem . '</td></tr>';

        $contenido .='</table>';*/
        
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->writeHTML(utf8_encode($contenido));


        //$pdf->Ln(10);
        $pdf->SetFont('Helvetica', '', 5);
        $pdf->writeHTML('cc. ' . strtoupper($rs->copias));
        $pdf->writeHTML('Adj. ' . strtoupper($rs->adjuntos));
        $pdf->writeHTML(strtoupper($rs->mosca_remitente));
        //$pdf->writeHTML();
        /*   $pdf->SetY(-5);
          // Set font
          $pdf->SetFont('helvetica', 'I', 7);
          $pdf->Write(0, $fecha,'',0,'L');
         * */

        $nombre.='_' . substr($rs->cite_original, -10, 6);
    }
    //echo "<BR><B>".date("r")."</B>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Close and output PDF document
$pdf->Output($nombre . '.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
