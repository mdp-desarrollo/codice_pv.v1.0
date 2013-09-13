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
        if($id_entidad<>2){
        $this->Image($image_file, 20, 7, 40, 23, 'PNG');
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
    $stmt = $dbh->prepare("SELECT * FROM documentos d 
                               INNER JOIN tipos t ON d.id_tipo=t.id
                               WHERE d.id='$id'");
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    $mes = (int) date('m', strtotime($rs->fecha_creacion));
    $meses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
    //$fecha = $esp.date('d', strtotime($rs->fecha_creacion)) . ' de ' . $meses[$mes] . ' de ' . date('Y', strtotime($rs->fecha_creacion));
    ///documento para el fucov
    $stmt = $dbh->prepare("SELECT * FROM documentos WHERE id=$id");
    $stmt->execute();
    $documento = $stmt->fetch(PDO::FETCH_OBJ);
    
    ///oficina solicitante
    $stmt = $dbh->prepare("SELECT * FROM oficinas WHERE id=$documento->id_oficina");
    $stmt->execute();
    $oficina = $stmt->fetch(PDO::FETCH_OBJ);
    
    ///Unidad Ejecutora
    $stmt = $dbh->prepare("SELECT * FROM oficinas WHERE id=$oficina->id");
    $stmt->execute();
    $oficina2 = $stmt->fetch(PDO::FETCH_OBJ);
    while($oficina2->ppt_unid_ejecutora == NULL || $oficina2->ppt_unid_ejecutora == 0){
        $stmt = $dbh->prepare("SELECT * FROM oficinas WHERE id=$oficina->padre");
        $stmt->execute();
        $oficina2 = $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    ///FUCOV
    $stmt = $dbh->prepare("SELECT * FROM pvfucovs WHERE id=$id_fucov");
    $stmt->execute();
    $pvfucov = $stmt->fetch(PDO::FETCH_OBJ);
    
    ///POA
    $stmt = $dbh->prepare("select * from pvpoas where id_fucov = $pvfucov->id");
    $stmt->execute();
    $pvpoa = $stmt->fetch(PDO::FETCH_OBJ);
    
    ///objetivos
    $stmt = $dbh->prepare("select og.codigo cod_gest, oe.codigo cod_esp from pvogestiones og inner join pvoespecificos oe on og.id = oe.id_obj_gestion 
                           where og.id_oficina = $oficina2->id  and og.id = $pvpoa->id_obj_gestion  and oe.id = $pvpoa->id_obj_esp");
    $stmt->execute();
    $pvobjetivos = $stmt->fetch(PDO::FETCH_OBJ);
    
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->write(0,'CERTIFICACION POA','',0,'C');
    $color = "#CBCBCB";
    $tabla1 = "
        <table style=\" width: 600px;\"  border=\"0px\">
            <tr>
                <td style = \" width: 100%;\"><b>I. SOLICITUD</b></td>
            </tr>
            <tr>
                <td style = \" width: 100%;\">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table border = \"1px\" STYLE=\" WIDTH:580px;\">
                        <tr>
                            <td style=\"width: 150px;\" bgcolor=\"$color\">UNIDAD SOLICITANTE:</td>
                            <td style=\"width: 300px;\">$oficina->oficina</td>
                            <td style=\"width: 130px;\">Dependiencia: $oficina2->sigla</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style = \" width: 100%;\">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table border = \"1px\" STYLE=\" WIDTH:580px;\">
                        <tr bgcolor=\"$color\">
                            <td style=\"width: 120px; text align:center\">POA</td>
                            <td style=\"width: 60px;\">CODIGO</td>
                            <td style=\"width: 40px;\" ></td>
                            <td style=\"width: 60px;\" >CODIGO:</td>
                            <td style=\"width: 300px;\" >ACTIVIDAD - DESCRIPCION SEGUN POA</td>
                        </tr>
                        <tr>
                            <td>Objetivo de Gestion</td>
                            <td>$pvobjetivos->cod_gest</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Objetivo Especifico</td>
                            <td>$pvobjetivos->cod_esp</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style = \" width: 100%;\">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table border = \"1px\" style=\" width:180px;\">
                        <tr bgcolor=\"$color\">
                            <td colspan=\"2\" >TIPO DE ACTIVIDAD</td>
                        </tr>
                        <tr>
                            <td style=\"width: 120px;\">INVERSION</td>
                            <td style=\"width: 60px;\"></td>
                        </tr>
                        <tr>
                            <td>FUNCIONAMIENTO</td>
                            <td><b>X</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style = \" width: 100%;\">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table border = \"1px\" style=\" width:300px;\">
                        <tr bgcolor=\"$color\">
                            <td colspan=\"2\" >TIPO DE CONTRATACION</td>
                        </tr>
                        <tr>
                            <td style=\"width: 250px;\">Consultoria Individual de linea</td>
                            <td style=\"width: 50px;\"></td>
                        </tr>
                        <tr>
                            <td>Consultoria Individual por producto</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Servicios de Empresa consultora(estidios)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Adquisicion de Bienes</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Contratacion de obras</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Otros</td>
                            <td><b>X</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style = \" width: 100%;\">&nbsp;</td>
            </tr>
            <!--<tr>
                <td>
                    <table border = \"1px\" style=\" width:580px;\">
                        <tr bgcolor=\"$color\">
                            <td style=\"width: 400px;\">PROCESO DE CONTRATACION / ADQUISICION:</td>
                            <td style=\"width: 60px;\">Cantidad</td>
                            <td style=\"width: 60px;\">Monto Total(Bs)</td>
                            <td style=\"width: 60px;\">Plazo de ejecucion</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>-->
            <tr>
                <td style = \" width: 100%;\">&nbsp;</td>
            </tr>
        </table>";
    $pdf->Ln(20);
    $pdf->writeHTML($tabla1, false, false, false);
    $fecha = date("d / m / Y");
    $tabla2 = "
    <table style=\"width: 600px;\"  border=\"0px\" >
            <tr bgcolor = \"$color\">
                <td style = \" width: 100%;\"><b>II. CERTIFICACION (llenado por la DGP)</b></td>
            </tr>
            <tr>
                <td style = \" width: 100%;\">
                    <p><center>
                    <table border = \"1px\" style=\" width:580px;\" >
                        <tr>
                            <td>En cumplimiento de los reglamentos Especificos del Sistema de Programacion de Operaciones y del Sistema de 
                            Administracion de Bienes y servicios del MDPyEP, la Direccion General de Planificacion <b>Certifica</b> que la actividad solicitada
                            se encuentra inscrita en el POA 2013 del MDPyEP.</td>
                        </tr>
                    </table>
                    </center>
                    </p>
                </td>
            </tr>
            <tr>
                <td style = \" width: 100%;\" bgcolor = \"$color\"><b>Responsable de la certificacion</b></td>
            </tr>
            <tr>
                <td><p>
                    <table border = \"1px\" style=\" width:580px;\" >
                        <tr>
                            <td style=\"width: 80px;\" bgcolor = \"$color\">Responsable Verificacion POA</td>
                            <td style=\"width: 210px;\"><span style=\"color:#DADADA; text-align:center;\"><br /><br />FIRMA</span></td>
                            <td style=\"width: 210px;\"><span style=\"color:#DADADA; text-align:center;\"><br /><br />SELLO</span></td>
                            <td style=\"width: 80px;\">FECHA</td>
                        </tr>
                        <tr>
                            <td bgcolor = \"$color\">Direccion General de Planificacion</td>
                            <td><span style=\"color:#DADADA; text-align:center;\"><br /><br />FIRMA</span></td>
                            <td><span style=\"color:#DADADA; text-align:center;\"><br /><br />SELLO</span></td>
                            <td><span style=\"text-align:center;\"><br />$fecha</span></td>
                        </tr>
                    </table>                
                    </p>
                </td>
            </tr>
    </table>
    ";
    $pdf->Ln(10);
    $pdf->writeHTML($tabla2, false, false, false);
        
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Close and output PDF document
$pdf->Output($nombre . '.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
