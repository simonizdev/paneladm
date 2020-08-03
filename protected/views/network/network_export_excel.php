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

  $objPHPExcel->setActiveSheetIndex()->setCellValue('A1', 'IP');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B1', 'Estado');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C1', 'Notas');

  $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);

  $Prom = "";
  $Fila= 3;

  /*Inicio contenido tabla*/

  foreach ($data as $reg) {

    if($reg->Estado == 1 || $reg->Estado == 3){
      $notas = "-";
    }

    if($reg->Estado == 2){
      $e_n_act =NetworkEquipo::model()->findByAttributes(array('Estado' => 1, 'Id_Network' => $reg->Id));
      if($e_n_act->Notas == ""){
        $notas = "-";
      }else{
        $notas = $e_n_act->Notas;
      }

    }

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila,$reg->Ip($reg->Id));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila,$reg->DescEstado($reg->Id));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$Fila,$notas);
    
    $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila.':C'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

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

  $n = 'Network_'.date('Y-m-d H_i_s');

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="'.$n.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
  ob_end_clean();
  $objWriter->save('php://output');
  exit;
  
?>

