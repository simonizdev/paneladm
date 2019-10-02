<?php
/* @var $this ReporteController */
/* @var $model Reporte */

set_time_limit(0);

if (isset($model['empresa_compra'])) { $empresa_compra = $model['empresa_compra']; } else { $empresa_compra = ""; }
if (isset($model['tipo_equipo'])) { $tipo_equipo = $model['tipo_equipo']; } else { $tipo_equipo = "";  }

//se arma el arreglo con los datos para el reporte

//Condición de empresa

if($empresa_compra != ""){
  //una o varias empresas
  
  $a_emp = implode(",", $empresa_compra);
  $qe = "SELECT * FROM TH_EMPRESA WHERE Estado = 1 AND Id_Empresa IN (".$a_emp.") ORDER BY Descripcion";

}else{
  //todas las empresas
  $qe = "SELECT * FROM TH_EMPRESA WHERE Estado = 1 ORDER BY Descripcion";
}

$array_equipos_empresa = array();

$q_empresas = Yii::app()->db->createCommand($qe)->queryAll();

foreach ($q_empresas as $empresas) {

  $id_emp = $empresas['Id_Empresa'];
  $desc_emp = $empresas['Descripcion'];

  if($tipo_equipo != ""){    
    $a_tipos = implode(",", $tipo_equipo);
    $q_equipos_x_empresa = Yii::app()->db->createCommand("SELECT COUNT(*) AS Num_Equipos FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$a_tipos.") AND Empresa_Compra = ".$id_emp)->queryRow();
  }else{
    $q_equipos_x_empresa = Yii::app()->db->createCommand("SELECT COUNT(*) AS Num_Equipos FROM TH_EQUIPO WHERE Estado = 1 AND Empresa_Compra = ".$id_emp)->queryRow();
  }

  //EQUIPOS POR EMPRESA
  $num_equipo_x_empresa = $q_equipos_x_empresa['Num_Equipos'];

  if($num_equipo_x_empresa != "" && $num_equipo_x_empresa > 0){
    
    $array_equipos_empresa[$id_emp]['desc_empresa'] = $desc_emp;
    $array_equipos_empresa[$id_emp]['cant_equipos_x_empresa'] = $q_equipos_x_empresa['Num_Equipos'];
    $array_equipos_empresa[$id_emp]['cant_equipos_x_tipo'] = array();

    //EQUIPOS POR EMPRESA / TIPO EQUIPO
    
    if($tipo_equipo != ""){
      //uno o varios tipos de equipo
      
      $a_tipos = implode(",", $tipo_equipo);
      $qte = "SELECT * FROM TH_DOMINIO WHERE Id_Padre = ".Yii::app()->params->tipo_equipo." AND Estado = 1 AND Id_Dominio IN (".$a_tipos.") ORDER BY Dominio";

    }else{
      //todos los tipos de equipo
      $qte = "SELECT * FROM TH_DOMINIO WHERE Id_Padre = ".Yii::app()->params->tipo_equipo." AND Estado = 1 ORDER BY Dominio";
    }


    $q_tipos_equipo = Yii::app()->db->createCommand($qte)->queryAll();

    foreach ($q_tipos_equipo as $tipos) {

      $id_tipo = $tipos['Id_Dominio'];
      $desc_tipo_equipo = $tipos['Dominio'];

      $q_equipos_x_empresa_x_tipo = Yii::app()->db->createCommand("SELECT COUNT(*) AS Num_Equipos FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo = ".$id_tipo." AND Empresa_Compra = ".$id_emp)->queryRow();

      $num_equipo_x_empresa_x_tipo = $q_equipos_x_empresa_x_tipo['Num_Equipos'];

      if($num_equipo_x_empresa_x_tipo != "" && $num_equipo_x_empresa_x_tipo > 0){  
        $tipo_inc = array('desc_tipo_equipo' => $desc_tipo_equipo, 'cant' => $num_equipo_x_empresa_x_tipo);
        array_push($array_equipos_empresa[$id_emp]['cant_equipos_x_tipo'], $tipo_inc);
      }
    }

    //EQUIPOS POR EMPRESA / TIPO DE LICENCIA S.O

    $q_tipos_licencia_so = Yii::app()->db->createCommand("SELECT * FROM TH_DOMINIO WHERE Id_Padre = ".Yii::app()->params->tipo_licencia." AND Estado = 1")->queryAll();

    $array_equipos_empresa[$id_emp]['cant_equipos_x_tipo_licencia_so'] = array();

    foreach ($q_tipos_licencia_so as $tipos_lic_so) {
    
      $id_tipo_licencia_so = $tipos_lic_so['Id_Dominio'];
      $desc_tipo_licencia_so = $tipos_lic_so['Dominio'];

      if($tipo_equipo != ""){    
        $a_tipos = implode(",", $tipo_equipo);
        $q_equipos_x_empresa_x_tipo_licencia_so = Yii::app()->db->createCommand("SELECT COUNT (DISTINCT Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_SO WHERE Estado = 1 AND Tipo_Licencia = ".$id_tipo_licencia_so." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$a_tipos.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }else{
        $q_equipos_x_empresa_x_tipo_licencia_so = Yii::app()->db->createCommand("SELECT COUNT (DISTINCT Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_SO WHERE Estado = 1 AND Tipo_Licencia = ".$id_tipo_licencia_so." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }

      $num_equipo_x_empresa_x_tipo_licencia_so = $q_equipos_x_empresa_x_tipo_licencia_so['Num_Equipos'];

      if($num_equipo_x_empresa_x_tipo_licencia_so != "" && $num_equipo_x_empresa_x_tipo_licencia_so > 0){ 
        
        $tipo_licencia_so = array('desc_tipo_licencia_so' => $desc_tipo_licencia_so, 'cant' => $num_equipo_x_empresa_x_tipo_licencia_so);
        array_push($array_equipos_empresa[$id_emp]['cant_equipos_x_tipo_licencia_so'], $tipo_licencia_so);

      }

    }

    //EQUIPOS POR EMPRESA / VERSIÓN S.O

    $q_versiones_so = Yii::app()->db->createCommand("SELECT * FROM TH_DOMINIO WHERE Id_Padre = ".Yii::app()->params->version_so." AND Estado = 1")->queryAll();

    $array_equipos_empresa[$id_emp]['cant_equipos_x_version_so'] = array();

    foreach ($q_versiones_so as $versiones_so) {
    
      $id_version_so = $versiones_so['Id_Dominio'];
      $desc_version_so = $versiones_so['Dominio'];

      if($tipo_equipo != ""){    
        $a_tipos = implode(",", $tipo_equipo);
        $q_equipos_x_empresa_x_version_so = Yii::app()->db->createCommand("SELECT COUNT (DISTINCT Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_SO WHERE Estado = 1 AND Version = ".$id_version_so." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$a_tipos.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }else{
        $q_equipos_x_empresa_x_version_so = Yii::app()->db->createCommand("SELECT COUNT (DISTINCT Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_SO WHERE Estado = 1 AND Version = ".$id_version_so." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }

      $num_equipo_x_empresa_x_version_so = $q_equipos_x_empresa_x_version_so['Num_Equipos'];

      if($num_equipo_x_empresa_x_version_so != "" && $num_equipo_x_empresa_x_version_so > 0){ 
        
        $tipo_version_so = array('desc_version_so' => $desc_version_so, 'cant' => $num_equipo_x_empresa_x_version_so);
        array_push($array_equipos_empresa[$id_emp]['cant_equipos_x_version_so'], $tipo_version_so);

      }

    }

    //EQUIPOS POR EMPRESA / TIPO DE LICENCIA OFFICE

    $q_tipos_licencia_office = Yii::app()->db->createCommand("SELECT * FROM TH_DOMINIO WHERE Id_Padre = ".Yii::app()->params->tipo_licencia." AND Estado = 1")->queryAll();

    $array_equipos_empresa[$id_emp]['cant_equipos_x_tipo_licencia_office'] = array();

    foreach ($q_tipos_licencia_office as $tipos_lic_office) {
    
      $id_tipo_licencia_office = $tipos_lic_office['Id_Dominio'];
      $desc_tipo_licencia_office = $tipos_lic_office['Dominio'];

      if($tipo_equipo != ""){    
        $a_tipos = implode(",", $tipo_equipo);
        $q_equipos_x_empresa_x_tipo_licencia_office = Yii::app()->db->createCommand("SELECT COUNT (Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_OFFICE WHERE Estado = 1 AND Tipo_Licencia = ".$id_tipo_licencia_office." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$a_tipos.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }else{
        $q_equipos_x_empresa_x_tipo_licencia_office = Yii::app()->db->createCommand("SELECT COUNT (Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_OFFICE WHERE Estado = 1 AND Tipo_Licencia = ".$id_tipo_licencia_office." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }

      $num_equipo_x_empresa_x_tipo_licencia_office = $q_equipos_x_empresa_x_tipo_licencia_office['Num_Equipos'];

      if($num_equipo_x_empresa_x_tipo_licencia_office != "" && $num_equipo_x_empresa_x_tipo_licencia_office > 0){ 
        
        $tipo_licencia_office = array('desc_tipo_licencia_office' => $desc_tipo_licencia_office, 'cant' => $num_equipo_x_empresa_x_tipo_licencia_office);
        array_push($array_equipos_empresa[$id_emp]['cant_equipos_x_tipo_licencia_office'], $tipo_licencia_office);

      }

    }

    //EQUIPOS POR EMPRESA / VERSIÓN OFFICE

    $q_versiones_office = Yii::app()->db->createCommand("SELECT * FROM TH_DOMINIO WHERE Id_Padre = ".Yii::app()->params->version_office." AND Estado = 1")->queryAll();

    $array_equipos_empresa[$id_emp]['cant_equipos_x_version_office'] = array();

    foreach ($q_versiones_office as $versiones_office) {
    
      $id_version_office = $versiones_office['Id_Dominio'];
      $desc_version_office = $versiones_office['Dominio'];

      if($tipo_equipo != ""){    
        $a_tipos = implode(",", $tipo_equipo);
        $q_equipos_x_empresa_x_version_so = Yii::app()->db->createCommand("SELECT COUNT (Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_OFFICE WHERE Estado = 1 AND Version = ".$id_version_office." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$a_tipos.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }else{
        $q_equipos_x_empresa_x_version_so = Yii::app()->db->createCommand("SELECT COUNT (Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_OFFICE WHERE Estado = 1 AND Version = ".$id_version_office." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Empresa_Compra = ".$id_emp.")")->queryRow();
      }

      $num_equipo_x_empresa_x_version_office = $q_equipos_x_empresa_x_version_so['Num_Equipos'];

      if($num_equipo_x_empresa_x_version_office != "" && $num_equipo_x_empresa_x_version_office > 0){ 
        
        $tipo_version_office = array('desc_version_office' => $desc_version_office, 'cant' => $num_equipo_x_empresa_x_version_office);
        array_push($array_equipos_empresa[$id_emp]['cant_equipos_x_version_office'], $tipo_version_office);

      }
    }
  }
}

//EXCEL

// Se inactiva el autoloader de yii
spl_autoload_unregister(array('YiiBase','autoload'));   

require_once Yii::app()->basePath . '/extensions/PHPExcel/Classes/PHPExcel.php';

//cuando se termina la accion relacionada con la libreria se activa el autoloader de yii
spl_autoload_register(array('YiiBase','autoload'));

$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->setTitle('Hoja1');
$objPHPExcel->setActiveSheetIndex();

//se recorre el arreglo para empezar a armar el excel

$Fila = 1;  

if(!empty($array_equipos_empresa)){
  foreach ($array_equipos_empresa as $array_empresa) {
    

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, $array_empresa['desc_empresa']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getFont()->setBold(true);

    $Fila = $Fila + 2;

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, 'EQUIPOS ACTIVOS');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $array_empresa['cant_equipos_x_empresa']);

    $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $Fila = $Fila + 1;

    //TIPOS DE EQUIPO
    if(array_key_exists('cant_equipos_x_tipo', $array_empresa)){

      $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, 'TIPO DE EQUIPO');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

      $equipos_x_tipo = $array_empresa['cant_equipos_x_tipo'];

      $tet = 0;

      foreach ($equipos_x_tipo as $tipo_equipo) {

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, $tipo_equipo['desc_tipo_equipo']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tipo_equipo['cant']);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $Fila = $Fila + 1;
        $tet = $tet + $tipo_equipo['cant'];

      }

      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tet);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

    }

    //TIPOS DE LICENCIA S.O
    if(array_key_exists('cant_equipos_x_tipo_licencia_so', $array_empresa)){

      $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, 'TIPO DE LICENCIA S.O');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

      $equipos_x_tipo_licencia_so = $array_empresa['cant_equipos_x_tipo_licencia_so'];

      $tetlso = 0;

      foreach ($equipos_x_tipo_licencia_so as $tipo_licencia_so) {

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, $tipo_licencia_so['desc_tipo_licencia_so']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tipo_licencia_so['cant']);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $Fila = $Fila + 1;
        $tetlso = $tetlso + $tipo_licencia_so['cant'];

      }

      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tetlso);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

    }

    //VERSIONES S.O
    if(array_key_exists('cant_equipos_x_version_so', $array_empresa)){

      $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, 'VERSIÓN S.O');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

      $equipos_x_version_so = $array_empresa['cant_equipos_x_version_so'];

      $tevso = 0;

      foreach ($equipos_x_version_so as $version_so) {

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, $version_so['desc_version_so']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $version_so['cant']);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $Fila = $Fila + 1;
        $tevso = $tevso + $version_so['cant'];

      }

      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tevso);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

    }

    //TIPOS DE LICENCIA OFFICE
    if(array_key_exists('cant_equipos_x_tipo_licencia_office', $array_empresa)){

      $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, 'TIPO DE LICENCIA OFFICE');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

      $equipos_x_tipo_licencia_office = $array_empresa['cant_equipos_x_tipo_licencia_office'];

      $tetlo = 0;

      foreach ($equipos_x_tipo_licencia_office as $tipo_licencia_office) {

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, $tipo_licencia_office['desc_tipo_licencia_office']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tipo_licencia_office['cant']);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $Fila = $Fila + 1;
        $tetlo = $tetlo + $tipo_licencia_office['cant'];

      }

      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tetlo);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

    }

    //VERSIONES OFFICE
    if(array_key_exists('cant_equipos_x_version_office', $array_empresa)){

      $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, 'VERSIÓN OFFICE');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

      $equipos_x_version_office = $array_empresa['cant_equipos_x_version_office'];

      $tevo = 0;

      foreach ($equipos_x_version_office as $version_office) {

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$Fila, $version_office['desc_version_office']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $version_office['cant']);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $Fila = $Fila + 1;
        $tevo = $tevo + $version_office['cant'];
      }  

      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$Fila, $tevo);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$Fila)->getFont()->setBold(true);

      $Fila = $Fila + 1;

    }
  }
}

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

$n = 'Est_Equipos_'.date('Y-m-d H_i_s');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$n.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
ob_end_clean();
$objWriter->save('php://output');
exit;

?>











