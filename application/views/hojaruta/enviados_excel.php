<?php
error_reporting(E_ALL);
$id_user=$_GET['id_user'];
$id_oficina=$_GET['id_oficina'];
$fecha1=$_GET['fecha1'];
$fecha2=$_GET['fecha2'];
/** PHPExcel */
require_once 'libs/phpExcel/PHPExcel.php';
require_once 'libs/phpExcel/phpExcel/IOFactory.php';
// Check prerequisites
if (!file_exists("plantilla1.xlsx")) {
	exit("No se encontro la plantilla.\n");
}
$objPHPExcel = PHPExcel_IOFactory::load("plantilla1.xlsx");
$objPHPExcel->getProperties()->setCreator("Ivan Marcelo Chacolla")
							 ->setLastModifiedBy("")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Sistema de Correspondencia.")
							 ->setKeywords("Correspondenica enviada")
							 ->setCategory("");
//BORDES
$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
		'inside' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
                'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		),
	),
);
$styleArray = array(
	'font' => array(
		'bold' => true,
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
);
							 
$celda=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
$mes = array (1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre' );
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F1', '');
//$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);            
//$objPHPExcel->getActiveSheet()->mergeCells('A2:'.$celda[$hasta+1].'2');            
$C=0;//INICIAMOS EN A
$F=$FF=2;
//CELDAS
if($id_oficina>0)
{
    $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,d.cite_original,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo 
        FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_a_oficina='$id_oficina'
        AND s.derivado_por='$id_user'
        AND s.estado BETWEEN '1' and '4'   
        and d.original=1
        AND s.fecha_emision BETWEEN '$fecha1' AND '$fecha2'";
}
else
{
    $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,d.cite_original,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.derivado_por='$id_user'
        AND s.estado BETWEEN '1' and '4'   
        and d.original=1
        AND s.fecha_emision BETWEEN '$fecha1' AND '$fecha2'";
}
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=paperwork', 'root', '', array( PDO::ATTR_PERSISTENT => false));
$stmt = $dbh->prepare($sql);        
$stmt->execute();        
while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) 
{   
    
//titulo	
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$F.'', $rs->nur);
$objPHPExcel->getActiveSheet()->getStyle('A'.$F)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$F)->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$F.'', $rs->cite_original);
$destino=utf8_encode($rs->nombre_receptor."\n".$rs->cargo_receptor);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$F.'', $destino);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$F.'', utf8_encode($rs->proveido));
//$objPHPExcel->getActiveSheet()->mergeCells('A'.$F.':'.$celda[$hasta+1].$F);
$objPHPExcel->getActiveSheet()->getRowDimension(''.$F)->setRowHeight(113);
$F++; 
$C=0;	
}
//bordes
$objPHPExcel->getActiveSheet()->getStyle('A2:E'.($F-1))->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A2:E'.($F-1))->applyFromArray($styleArray);
$locale = 'Es';
$validLocale = PHPExcel_Settings::setLocale($locale);

//header
$sheet = $objPHPExcel->getActiveSheet();
/*$objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
$objDrawing->setPath('media/images/logo.jpg');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->addImage($objDrawing,PHPExcel_Worksheet_HeaderFooter::IMAGE_HEADER_LEFT);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&G');
//header
//$sheet = $objPHPExcel->getActiveSheet();
$objDrawing2 = new PHPExcel_Worksheet_HeaderFooterDrawing();
$objDrawing2->setPath('media/images/logo.jpg');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->addImage($objDrawing2,PHPExcel_Worksheet_HeaderFooter::IMAGE_HEADER_RIGHT);
 */
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&G&C&B      &15               CORRESPONDENCIA ENVIADA                                                                                                                                                   &12$fecha1&R&G');

/*
//TITULOS
$objPHPExcel->getActiveSheet()->getStyle('A3:Q3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A3:Q3')->getFill()->getStartColor()->setARGB('FF252525');
$objPHPExcel->getActiveSheet()->getStyle('A3:Q3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
*/
// Renombramos la hoja
$objPHPExcel->getActiveSheet()->setTitle('2012');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Correspondencia_enviada.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;