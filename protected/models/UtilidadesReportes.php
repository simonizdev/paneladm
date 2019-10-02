<?php

//clase creada para funciones relacionadas con el modelo de reportes

class UtilidadesReportes {
  
  public static function estequipospantalla($empresa_compra, $tipo_equipo) {
    
    //se arma el arreglo con los datos para el reporte

    //Condición de empresa

    if($empresa_compra != ""){
      //una o varias empresas
      
      $a_emp = $empresa_compra;
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
        $q_equipos_x_empresa = Yii::app()->db->createCommand("SELECT COUNT(*) AS Num_Equipos FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$tipo_equipo.") AND Empresa_Compra = ".$id_emp)->queryRow();
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
          $a_tipos = $tipo_equipo;
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
            $q_equipos_x_empresa_x_tipo_licencia_so = Yii::app()->db->createCommand("SELECT COUNT (DISTINCT Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_SO WHERE Estado = 1 AND Tipo_Licencia = ".$id_tipo_licencia_so." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$tipo_equipo.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
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
            $q_equipos_x_empresa_x_version_so = Yii::app()->db->createCommand("SELECT COUNT (DISTINCT Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_SO WHERE Estado = 1 AND Version = ".$id_version_so." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$tipo_equipo.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
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
            $q_equipos_x_empresa_x_tipo_licencia_office = Yii::app()->db->createCommand("SELECT COUNT (Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_OFFICE WHERE Estado = 1 AND Tipo_Licencia = ".$id_tipo_licencia_office." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$tipo_equipo.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
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
            $q_equipos_x_empresa_x_version_so = Yii::app()->db->createCommand("SELECT COUNT (Id_Equipo) AS Num_Equipos FROM TH_EQUIPO_OFFICE WHERE Estado = 1 AND Version = ".$id_version_office." AND Id_Equipo IN (SELECT Id_Equipo FROM TH_EQUIPO WHERE Estado = 1 AND Tipo_Equipo IN (".$tipo_equipo.") AND Empresa_Compra = ".$id_emp.")")->queryRow();
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

    $tabla = '';

    if(!empty($array_equipos_empresa)){

      foreach ($array_equipos_empresa as $array_empresa) {

        $i=0;

        if ($i % 2 == 0){
          $clase = 'odd'; 
        }else{
          $clase = 'even'; 
        }
        
        $tabla .= '
        <table class="table table-striped table-hover" style="font-size: 12px !important;">
          <thead>
            <tr>
              <th colspan="2" style="font-weight: bold;font-size: 16px !important;">'.$array_empresa['desc_empresa'].'</th>
            </tr>
          </thead>
          <tbody>
        ';

        $i++;

        if ($i % 2 == 0){
          $clase = 'odd'; 
        }else{
          $clase = 'even'; 
        }

        $tabla .= '
          <tr class="'.$clase.'">
            <td>EQUIPOS ACTIVOS</td><td>'.$array_empresa['cant_equipos_x_empresa'].'</td>
          </tr>
        ';

        $i++;

        //TIPOS DE EQUIPO
        if(array_key_exists('cant_equipos_x_tipo', $array_empresa)){

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td colspan="2" style="font-weight: bold;">TIPO DE EQUIPO</td>
            </tr>
          ';

          $i++;

          $equipos_x_tipo = $array_empresa['cant_equipos_x_tipo'];

          $tet = 0;

          foreach ($equipos_x_tipo as $tipo_equipo) {

            if ($i % 2 == 0){
              $clase = 'odd'; 
            }else{
              $clase = 'even'; 
            }

            $tabla .= '
              <tr class="'.$clase.'">
                <td>'.$tipo_equipo['desc_tipo_equipo'].'</td><td>'.$tipo_equipo['cant'].'</td>
              </tr>
            ';

            $i++;
            $tet = $tet + $tipo_equipo['cant'];

          }

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td></td><td style="font-weight: bold;">'.$tet.'</td>
            </tr>
          ';

          $i++;

        }

        //TIPOS DE LICENCIA S.O
        if(array_key_exists('cant_equipos_x_tipo_licencia_so', $array_empresa)){

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td colspan="2" style="font-weight: bold;">TIPO DE LICENCIA S.O</td>
            </tr>
          ';

          $i++;

          $equipos_x_tipo_licencia_so = $array_empresa['cant_equipos_x_tipo_licencia_so'];

          $tetlso = 0;

          foreach ($equipos_x_tipo_licencia_so as $tipo_licencia_so) {

            if ($i % 2 == 0){
              $clase = 'odd'; 
            }else{
              $clase = 'even'; 
            }

            $tabla .= '
              <tr class="'.$clase.'">
                <td>'.$tipo_licencia_so['desc_tipo_licencia_so'].'</td><td>'.$tipo_licencia_so['cant'].'</td>
              </tr>
            ';

            $i++;
            $tetlso = $tetlso + $tipo_licencia_so['cant'];

          }

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td></td><td style="font-weight: bold;">'.$tetlso.'</td>
            </tr>
          ';

          $i++;

        }

        //VERSIONES S.O
        if(array_key_exists('cant_equipos_x_version_so', $array_empresa)){

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td colspan="2" style="font-weight: bold;">VERSIÓN S.O</td>
            </tr>
          ';

          $i++;

          $equipos_x_version_so = $array_empresa['cant_equipos_x_version_so'];

          $tevso = 0;

          foreach ($equipos_x_version_so as $version_so) {

            if ($i % 2 == 0){
              $clase = 'odd'; 
            }else{
              $clase = 'even'; 
            }

            $tabla .= '
              <tr class="'.$clase.'">
                <td>'.$version_so['desc_version_so'].'</td><td>'.$version_so['cant'].'</td>
              </tr>
            ';

            $i++;
            $tevso = $tevso + $version_so['cant'];

          }

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td></td><td style="font-weight: bold;">'.$tevso.'</td>
            </tr>
          ';

          $i++;

        }

        //TIPOS DE LICENCIA OFFICE
        if(array_key_exists('cant_equipos_x_tipo_licencia_office', $array_empresa)){

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td colspan="2" style="font-weight: bold;">TIPO DE LICENCIA OFFICE</td>
            </tr>
          ';

          $i++;

          $equipos_x_tipo_licencia_office = $array_empresa['cant_equipos_x_tipo_licencia_office'];

          $tetlo = 0;

          foreach ($equipos_x_tipo_licencia_office as $tipo_licencia_office) {

            if ($i % 2 == 0){
              $clase = 'odd'; 
            }else{
              $clase = 'even'; 
            }

            $tabla .= '
              <tr class="'.$clase.'">
                <td>'.$tipo_licencia_office['desc_tipo_licencia_office'].'</td><td>'.$tipo_licencia_office['cant'].'</td>
              </tr>
            ';

            $i++;
            $tetlo = $tetlo + $tipo_licencia_office['cant'];

          }

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td></td><td style="font-weight: bold;">'.$tetlo.'</td>
            </tr>
          ';

          $i++;

        }

        //VERSIONES OFFICE
        if(array_key_exists('cant_equipos_x_version_office', $array_empresa)){

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td colspan="2" style="font-weight: bold;">VERSIÓN OFFICE</td>
            </tr>
          ';

          $i++;

          $tevo = 0;

          $equipos_x_version_office = $array_empresa['cant_equipos_x_version_office'];

          foreach ($equipos_x_version_office as $version_office) {

            if ($i % 2 == 0){
              $clase = 'odd'; 
            }else{
              $clase = 'even'; 
            }

            $tabla .= '
              <tr class="'.$clase.'">
                <td>'.$version_office['desc_version_office'].'</td><td>'.$version_office['cant'].'</td>
              </tr>
            ';

            $i++;
            $tevo = $tevo + $version_office['cant'];

          }

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '
            <tr class="'.$clase.'">
              <td></td><td style="font-weight: bold;">'.$tevo.'</td>
            </tr>
          ';

          $tabla .= '<br>';

        }
      }

      $tabla .= '  </tbody>
        </table>';

    }

    return $tabla;
  }

  public static function licequipospantalla($empresa_compra, $tipo_equipo, $tipo_lic, $version) {
    
    //se arma el arreglo con los datos para el reporte

    if($tipo_lic == Yii::app()->params->version_so){
      //S.O

      $condicion = "";

      if($empresa_compra != ""){
        $condicion .= "AND t2.Empresa_Compra IN (".$empresa_compra.")";
      }

      if($tipo_equipo != ""){
        $condicion .= "AND t2.Tipo_Equipo IN (".$tipo_equipo.")";
      }

      if($version != ""){
        $condicion .= "AND t1.Version = ".$version;
      } 

      $query = "
        SELECT
        t2.Serial AS Serial
        ,t2.Modelo AS Modelo
        ,t3.Dominio AS Tipo_Licencia
        ,t4.Dominio AS Version
        ,t1.Num_Licencia AS Licencia
        ,t5.Proveedor
        ,t6.Descripcion AS Empresa
        FROM TH_EQUIPO_SO t1
        INNER JOIN TH_EQUIPO AS t2 ON t1.Id_Equipo = t2.Id_Equipo
        INNER JOIN TH_DOMINIO AS t3 ON t1.Tipo_Licencia = t3.Id_Dominio
        INNER JOIN TH_DOMINIO AS t4 ON t1.Version = t4.Id_Dominio
        INNER JOIN TH_PROVEEDOR AS t5 ON t2.Proveedor = t5.Id_Proveedor
        INNER JOIN TH_EMPRESA AS t6 ON t2.Empresa_Compra = t6.Id_Empresa
        WHERE 1 = 1
        ".$condicion."
        ORDER BY 3,5
      ";

    }

    if($tipo_lic == Yii::app()->params->version_office){
      //Office
      
       $condicion = "";

      if($empresa_compra != ""){
        $condicion .= "AND t1.Empresa_Compra IN (".$empresa_compra.")";
      }

      if($tipo_equipo != ""){
        $condicion .= "AND t2.Tipo_Equipo IN (".$tipo_equipo.")";
      }

      if($version != ""){
        $condicion .= "AND t1.Version = ".$version;
      } 

      $query = "
        SELECT
        t2.Serial AS Serial
        ,t2.Modelo AS Modelo
        ,t3.Dominio AS Tipo_Licencia
        ,t4.Dominio AS Version
        ,t1.Num_Licencia AS Licencia
        ,t1.Fecha_Inicio as Fecha_Inicio
        ,t1.Fecha_Final as Fecha_Fin
        ,t5.Proveedor
        ,t6.Descripcion AS Empresa
        FROM TH_EQUIPO_OFFICE t1
        INNER JOIN TH_EQUIPO AS t2 ON t1.Id_Equipo = t2.Id_Equipo
        INNER JOIN TH_DOMINIO AS t3 ON t1.Tipo_Licencia = t3.Id_Dominio
        INNER JOIN TH_DOMINIO AS t4 ON t1.Version = t4.Id_Dominio
        INNER JOIN TH_PROVEEDOR AS t5 ON t1.Proveedor = t5.Id_Proveedor
        INNER JOIN TH_EMPRESA AS t6 ON t1.Empresa_Compra = t6.Id_Empresa
        WHERE 1 = 1
        ".$condicion."
        ORDER BY 3,5
      ";

    }

    if($tipo_lic == Yii::app()->params->version_adobe){
      //Adobe
      
       $condicion = "";

      if($empresa_compra != ""){
        $condicion .= "AND t1.Empresa_Compra IN (".$empresa_compra.")";
      }

      if($tipo_equipo != ""){
        $condicion .= "AND t2.Tipo_Equipo IN (".$tipo_equipo.")";
      }

      if($version != ""){
        $condicion .= "AND t1.Version = ".$version;
      } 

      $query = "
        SELECT
        t2.Serial AS Serial
        ,t2.Modelo AS Modelo
        ,t3.Dominio AS Tipo_Licencia
        ,t4.Dominio AS Version
        ,t1.Num_Licencia AS Licencia
        ,t1.Fecha_Inicio as Fecha_Inicio
        ,t1.Fecha_Final as Fecha_Fin
        ,t5.Proveedor
        ,t6.Descripcion AS Empresa
        FROM TH_EQUIPO_ADOBE t1
        INNER JOIN TH_EQUIPO AS t2 ON t1.Id_Equipo = t2.Id_Equipo
        INNER JOIN TH_DOMINIO AS t3 ON t1.Tipo_Licencia = t3.Id_Dominio
        INNER JOIN TH_DOMINIO AS t4 ON t1.Version = t4.Id_Dominio
        INNER JOIN TH_PROVEEDOR AS t5 ON t1.Proveedor = t5.Id_Proveedor
        INNER JOIN TH_EMPRESA AS t6 ON t1.Empresa_Compra = t6.Id_Empresa
        WHERE 1 = 1
        ".$condicion."
        ORDER BY 3,5
      ";

    }

    if($tipo_lic == Yii::app()->params->version_autodesk){
      //Autodesk
        
       $condicion = "";

      if($empresa_compra != ""){
        $condicion .= "AND t1.Empresa_Compra IN (".$empresa_compra.")";
      }

      if($tipo_equipo != ""){
        $condicion .= "AND t2.Tipo_Equipo IN (".$tipo_equipo.")";
      }

      if($version != ""){
        $condicion .= "AND t1.Version = ".$version;
      } 

      $query = "
        SELECT
        t2.Serial AS Serial
        ,t2.Modelo AS Modelo
        ,t3.Dominio AS Tipo_Licencia
        ,t4.Dominio AS Version
        ,t1.Num_Licencia AS Licencia
        ,t5.Proveedor
        ,t6.Descripcion AS Empresa
        FROM TH_EQUIPO_AUTODESK t1
        INNER JOIN TH_EQUIPO AS t2 ON t1.Id_Equipo = t2.Id_Equipo
        INNER JOIN TH_DOMINIO AS t3 ON t1.Tipo_Licencia = t3.Id_Dominio
        INNER JOIN TH_DOMINIO AS t4 ON t1.Version = t4.Id_Dominio
        INNER JOIN TH_PROVEEDOR AS t5 ON t1.Proveedor = t5.Id_Proveedor
        INNER JOIN TH_EMPRESA AS t6 ON t1.Empresa_Compra = t6.Id_Empresa
        WHERE 1 = 1
        ".$condicion."
        ORDER BY 3,5
      ";

    }

    if($tipo_lic == Yii::app()->params->version_antivirus){
      //Antivirus
        
       $condicion = "";

      if($empresa_compra != ""){
        $condicion .= "AND t1.Empresa_Compra IN (".$empresa_compra.")";
      }

      if($tipo_equipo != ""){
        $condicion .= "AND t2.Tipo_Equipo IN (".$tipo_equipo.")";
      }

      if($version != ""){
        $condicion .= "AND t1.Version = ".$version;
      } 

      $query = "
        SELECT
        t2.Serial AS Serial
        ,t2.Modelo AS Modelo
        ,t3.Dominio AS Tipo_Licencia
        ,t4.Dominio AS Version
        ,t1.Num_Licencia AS Licencia
        ,t5.Proveedor
        ,t6.Descripcion AS Empresa
        FROM TH_EQUIPO_ANTIVIRUS t1
        INNER JOIN TH_EQUIPO AS t2 ON t1.Id_Equipo = t2.Id_Equipo
        INNER JOIN TH_DOMINIO AS t3 ON t1.Tipo_Licencia = t3.Id_Dominio
        INNER JOIN TH_DOMINIO AS t4 ON t1.Version = t4.Id_Dominio
        INNER JOIN TH_PROVEEDOR AS t5 ON t1.Proveedor = t5.Id_Proveedor
        INNER JOIN TH_EMPRESA AS t6 ON t1.Empresa_Compra = t6.Id_Empresa
        WHERE 1 = 1
        ".$condicion."
        ORDER BY 3,5
      ";

    }

    if($tipo_lic == Yii::app()->params->version_so || $tipo_lic == Yii::app()->params->version_autodesk || $tipo_lic == Yii::app()->params->version_antivirus){

      $tabla = '
      <table class="table table-striped table-hover" style="font-size: 12px !important;">
        <thead>
          <tr>
            <th>Serial</th>
            <th>Modelo</th>
            <th>Tipo</th>
            <th>Versión</th>
            <th>Licencia</th>
            <th>Proveedor</th>
            <th>Empresa</th>
          </tr>
        </thead>
        <tbody>
      ';

    }

    if($tipo_lic == Yii::app()->params->version_office || $tipo_lic == Yii::app()->params->version_adobe){

      $tabla = '
      <table class="table table-striped table-hover" style="font-size: 12px !important;">
        <thead>
          <tr>
            <th>Serial</th>
            <th>Modelo</th>
            <th>Tipo</th>
            <th>Versión</th>
            <th>Licencia</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Proveedor</th>
            <th>Empresa</th>
          </tr>
        </thead>
        <tbody>
      ';

    }

    $q_lic = Yii::app()->db->createCommand($query)->queryAll();

    if(!empty($q_lic)){

      $i = 0;

      foreach ($q_lic as $reg1) {

        if($tipo_lic == Yii::app()->params->version_so || $tipo_lic == Yii::app()->params->version_autodesk || $tipo_lic == Yii::app()->params->version_antivirus){
      
          $Serial         = $reg1 ['Serial']; 
          $Modelo         = $reg1 ['Modelo']; 
          $Tipo_Licencia  = $reg1 ['Tipo_Licencia'];
          $Version        = $reg1 ['Version'];
          $Licencia       = $reg1 ['Licencia'];
          $Proveedor      = $reg1 ['Proveedor'];
          $Empresa        = $reg1 ['Empresa'];

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '    
          <tr class="'.$clase.'">
                <td>'.$Serial.'</td>
                <td>'.$Modelo.'</td>
                <td>'.$Tipo_Licencia.'</td>
                <td>'.$Version.'</td>
                <td>'.$Licencia.'</td>
                <td>'.$Proveedor.'</td>
                <td>'.$Empresa.'</td>
            </tr>';

          $i++;   

        }

        if($tipo_lic == Yii::app()->params->version_office || $tipo_lic == Yii::app()->params->version_adobe){

          $Serial         = $reg1 ['Serial']; 
          $Modelo         = $reg1 ['Modelo']; 
          $Tipo_Licencia  = $reg1 ['Tipo_Licencia'];
          $Version        = $reg1 ['Version'];
          $Licencia       = $reg1 ['Licencia'];
          
          if($reg1 ['Fecha_Fin'] != ""){
            $Fecha_Inicio   = $reg1 ['Fecha_Fin'];
          }else{
            $Fecha_Inicio   = '-';
          }

          if($reg1 ['Fecha_Fin'] != ""){
            $Fecha_Fin   = $reg1 ['Fecha_Fin'];
          }else{
            $Fecha_Fin   = '-';
          }
          
          $Proveedor      = $reg1 ['Proveedor'];
          $Empresa        = $reg1 ['Empresa'];

          if ($i % 2 == 0){
            $clase = 'odd'; 
          }else{
            $clase = 'even'; 
          }

          $tabla .= '    
          <tr class="'.$clase.'">
                <td>'.$Serial.'</td>
                <td>'.$Modelo.'</td>
                <td>'.$Tipo_Licencia.'</td>
                <td>'.$Version.'</td>
                <td>'.$Licencia.'</td>
                <td>'.$Fecha_Inicio.'</td>
                <td>'.$Fecha_Fin.'</td>
                <td>'.$Proveedor.'</td>
                <td>'.$Empresa.'</td>
            </tr>';

          $i++; 

        }   

      }

    }else{

      if($tipo_lic == Yii::app()->params->version_so || $tipo_lic == Yii::app()->params->version_autodesk || $tipo_lic == Yii::app()->params->version_antivirus){
      
        $tabla .= ' 
          <tr><td colspan="7" class="empty"><span class="empty">No se encontraron resultados.</span></td></tr>
        ';

      }  

      if($tipo_lic == Yii::app()->params->version_office || $tipo_lic == Yii::app()->params->version_adobe){

        $tabla .= ' 
          <tr><td colspan="9" class="empty"><span class="empty">No se encontraron resultados.</span></td></tr>
        ';

      }

    }

    $tabla .= '</tbody>
        </table>';

    return $tabla;
  }

}
