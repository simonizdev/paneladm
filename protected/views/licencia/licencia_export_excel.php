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
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B1', 'Clasif.');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C1', 'Tipo');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D1', 'Versión');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E1', 'Producto');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F1', 'N° de licencia');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G1', 'Usuarios x lic.');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H1', 'Usuarios x lic. disp.');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I1', 'Empresa que compro');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J1', 'Ubicación');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K1', 'N° de factura');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('L1', 'Estado');

  $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);

  $Prom = "";
  $Fila= 3;

  /*Inicio contenido tabla*/

  foreach ($data as $reg) {

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila,$reg->Id_Lic);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila,$reg->clasificacion->Dominio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$Fila,$reg->tipo->Dominio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$Fila,$reg->version->Dominio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$Fila,($reg->Producto == "") ? "-" : $reg->producto->Dominio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$Fila,($reg->Num_Licencia == "") ? "-" : $reg->Num_Licencia);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$Fila,$reg->Cant_Usuarios);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$Fila,$reg->CantUsuariosRest($reg->Id_Lic));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$Fila,($reg->Empresa_Compra == "") ? "-" : $reg->empresacompra->Descripcion);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$Fila,($reg->Ubicacion == "") ? "-" : $reg->ubicacion->Dominio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$Fila,$reg->Numero_Factura);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$Fila,($reg->Estado == "") ? "-" : $reg->estado->Dominio);

    $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila.':L'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

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

  $n = 'Licencia_'.date('Y-m-d H_i_s');

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="'.$n.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
  ob_end_clean();
  $objWriter->save('php://output');
  exit;
  
?>

