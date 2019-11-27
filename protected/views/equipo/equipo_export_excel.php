<?php
/* @var $this PromocionController */
/* @var $model Promocion */

//EXCEL

  // Se inactiva el autoloader de yii
  spl_autoload_unregister(array('YiiBase','autoload'));   

  require_once Yii::app()->basePath . '/extensions/PHPExcel/Classes/PHPExcel.php';
  
  //cuando se termina la accion relacionada con la libreria se activa el autoloader de yii
  spl_autoload_register(array('YiiBase','autoload'));

  $objPHPExcel = new PHPExcel();

  $objPHPExcel->getActiveSheet()->setTitle('Hoja1');
  $objPHPExcel->setActiveSheetIndex();

  /*Cabecera tabla*/

  $objPHPExcel->setActiveSheetIndex()->setCellValue('A1', 'ID');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B1', 'Tipo');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C1', 'Serial');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D1', 'Empresa que compro');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E1', 'N° de factura');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F1', 'Fecha de compra');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G1', 'Proveedor');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H1', 'Estado');

  $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

  $Prom = "";
  $Fila= 3;

  /*Inicio contenido tabla*/

  foreach ($data as $reg) {

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila,$reg->Id_Equipo);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila,$reg->tipoequipo->Dominio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$Fila,$reg->Serial);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$Fila,$reg->empresacompra->Descripcion);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$Fila,$reg->Numero_Factura);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$Fila,UtilidadesVarias::textofecha($reg->Fecha_Compra));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$Fila,$reg->proveedor->Proveedor);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$Fila,UtilidadesVarias::textoestado1($reg->Estado));
    

    $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila.':H'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $Fila ++;
         
  }

  /*fin contenido tabla*/

  //se configura el ancho de cada columna en automatico solo funciona en el rango A-Z
  foreach($objPHPExcel->getWorksheetIterator() as $worksheet) {

      $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

      $sheet = $objPHPExcel->getActiveSheet();
      $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(true);
      foreach ($cellIterator as $cell) {
          $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
      }
  }

  $n = 'Equipo_'.date('Y-m-d H_i_s');

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="'.$n.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
  ob_end_clean();
  $objWriter->save('php://output');
  exit;
  
?>

