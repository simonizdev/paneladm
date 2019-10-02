<?php

class ReporteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform actions
				'actions'=>array('searchequipo', 'zipsoportes','soportesequipo','estequipos','estequipospant','licequipos','loadversiones', 'licequipospant'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionSearchEquipo(){
		$filtro = $_GET['q'];

		$b=new Reporte;

        $data = $b->searchByEquipo($filtro);
        $result = array();
        foreach($data as $item):
           $result[] = array(
               'id'   => $item['Id_Equipo'],
               'text' => $item['Serial'].' ('.$item['T_Equipo'].' - '.$item['Empresa'].')',
           );
        endforeach;
        header('Content-type: application/json');
        echo CJSON::encode( $result );
        Yii::app()->end(); 
 	}

 	public function actionZipSoportes()
	{		
		$model=new Reporte;
		$model->scenario = 'zip_soportes';

		$tipos_equipo= Yii::app()->db->createCommand('SELECT te.Id_Dominio, te.Dominio FROM TH_DOMINIO te WHERE te.Id_Padre = '.Yii::app()->params->tipo_equipo.' AND te.Estado = 1 ORDER BY te.Dominio')->queryAll();

		$empresas= Yii::app()->db->createCommand('SELECT e.Id_Empresa, e.Descripcion FROM TH_EMPRESA e WHERE e.Estado = 1 ORDER BY e.Descripcion')->queryAll();

		$this->render('zip_soportes',array(
			'model'=>$model,
			'tipos_equipo'=>$tipos_equipo,
			'empresas'=>$empresas,
		));
	}


	public function actionSoportesEquipo()
	{

		$opc = $_POST['opc'];
		$serial = $_POST['serial'];
		$fecha_compra_inicial = $_POST['fecha_compra_inicial'];
		$fecha_compra_final = $_POST['fecha_compra_final'];
		$empresa_compra = $_POST['empresa_compra'];
		$tipos_equipo = $_POST['tipos_equipo'];
		$inc_lic = $_POST['inc_lic']; 

		if($opc == 1){
		  //individual

		  $query = "SELECT Id_Equipo, Serial, Doc_Soporte FROM TH_EQUIPO WHERE Estado = 1";

		  if($serial != ""){
		    $query .= " AND Id_Equipo = ".$serial;  
		  }

		}

		if($opc == 2){
		  //grupal

		  $query = "SELECT Id_Equipo, Serial, Doc_Soporte FROM TH_EQUIPO WHERE Estado = 1";

		  if($fecha_compra_inicial != "" && $fecha_compra_final != ""){
		    $query .= " AND Fecha_Compra BETWEEN '".$fecha_compra_inicial."' AND '".$fecha_compra_final."'";  
		  }else{
		    if($fecha_compra_inicial != "" && $fecha_compra_final == ""){
      		$query .= " AND Fecha_Compra = '".$fecha_compra_inicial."'";  
		    } 
		  }

		  if($empresa_compra != ""){
				$query .= " AND Empresa_Compra = ".$empresa_compra;  
		  }

		  if($tipos_equipo != ""){
		    $query .= " AND Tipo_Equipo IN (".$tipos_equipo.")"; 
		  }
		}

		$q_equipos = Yii::app()->db->createCommand($query)->queryAll();


		if(empty($q_equipos)){
			$resp = 0;
			$msg = "No se encontraron soportes de equipos con los filtros aplicados.";
			$ruta = "";
			$archivo = "";
			$resp = array('resp' => $resp, 'msg' => $msg, 'ruta' => $ruta, 'archivo' => $archivo);
    		echo json_encode($resp);
		}else{

			//se empieza a generar el zip de acuerdo a los equipos y licencias relacionadas

			$array_ids = array();
			$array_equipos_seriales = array();
			$array_equipos_soportes = array();
			$array_so_seriales = array();
			$array_so_soportes = array();
			$array_office_seriales = array();
			$array_office_soportes = array();

			foreach ($q_equipos as $reg) {

			  $Id_Equipo = $reg['Id_Equipo'];
			  $Serial = $reg['Serial'];
			  $Doc_Soporte_Equipo = $reg['Doc_Soporte'];

				array_push($array_ids, $Id_Equipo);		 

			  $ruta_sop_equipo = Yii::app()->basePath.'/../images/docs_equipos_licencias/equipos/'.$Doc_Soporte_Equipo;
			        
			  if(file_exists($ruta_sop_equipo)){
			  	array_push($array_equipos_seriales, $Serial);
			    array_push($array_equipos_soportes, $Doc_Soporte_Equipo);
			  }

			  if($inc_lic != ""){
			  	//se deben incluir en las busqueda licencias de S.O y/o Office

			  	$inc_licencias = explode(",", $inc_lic);

			  	if(in_array(1, $inc_licencias)){
			  		//S.O
			  		$modelo_so = EquipoSo::model()->findAllByAttributes(array('Id_Equipo' => $Id_Equipo, 'Estado' => 1));

			  		if(!empty($modelo_so)){
			  			foreach ($modelo_so as $so_equipo) {

			  				$Doc_Soporte_SO = $so_equipo->Doc_Soporte;
			  				$Doc_Soporte_SO2 = $so_equipo->Doc_Soporte2;

	  						$ruta_sop_so = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$Doc_Soporte_SO;

	  						if(file_exists($ruta_sop_so)){
							  	array_push($array_so_seriales, $Serial);
							    array_push($array_so_soportes, $Doc_Soporte_SO);
							  }

							  if($Doc_Soporte_SO2 != ""){
					  			$ruta_sop_so2 = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$Doc_Soporte_SO2;

		  						if(file_exists($ruta_sop_so2)){
								  	array_push($array_so_seriales, $Serial);
								    array_push($array_so_soportes, $Doc_Soporte_SO2);
								  }
							  }
			  			}
			  		}
			  	}

			  	if(in_array(2, $inc_licencias)){
			  		//Office
			  		$modelo_office = EquipoOffice::model()->findAllByAttributes(array('Id_Equipo' => $Id_Equipo, 'Estado' => 1));

			  		if(!empty($modelo_office)){
			  			foreach ($modelo_office as $office_equipo) {

			  				$Doc_Soporte_Office = $office_equipo->Doc_Soporte;
			  				$Doc_Soporte_Office2 = $office_equipo->Doc_Soporte2;

	  						$ruta_sop_office = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$Doc_Soporte_Office;

	  						if(file_exists($ruta_sop_office)){
							  	array_push($array_office_seriales, $Serial);
							    array_push($array_office_soportes, $Doc_Soporte_Office);
							  }

							  if($Doc_Soporte_Office2 != ""){
					  			$ruta_sop_office2 = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$Doc_Soporte_Office2;

		  						if(file_exists($ruta_sop_office2)){
								  	array_push($array_office_seriales, $Serial);
								    array_push($array_office_soportes, $Doc_Soporte_Office2);
								  }
							  }
			  			}
			  		}
			  	}
			 	}
			}

			//se recorre el array
			if(!empty($array_equipos_seriales)){

				//se borran los archivos .zip y .txt que estaban en la carpeta

				$files = glob(Yii::app()->basePath.'/../zip/*'); //obtenemos todos los nombres de los ficheros
				foreach($files as $file){
				    if(is_file($file))
				    	unlink($file); //elimino el fichero
				}

				//se crea el texto especificando que filtros de busqueda se utilizaron
			  $txt_info = fopen(Yii::app()->basePath.'/../zip/filtro_busqueda.txt', 'w');

			  fwrite($txt_info, "Filtros de busqueda: " . PHP_EOL);

			  if($opc == 1){
				  //individual

				  if($serial != ""){
				  	$modelo_equipo = Equipo::model()->findByPk($serial);
				    fwrite($txt_info, "Serial:  ".$modelo_equipo->Serial. PHP_EOL);
				  } 

				}

				if($opc == 2){
				  //grupal

				  if($fecha_compra_inicial != "" && $fecha_compra_final != ""){
				    fwrite($txt_info, "Fecha de compra:  ".$fecha_compra_inicial." Al ".$fecha_compra_final .PHP_EOL);
				  }else{
				    if($fecha_compra_inicial != "" && $fecha_compra_final == ""){
		      		fwrite($txt_info, "Fecha de compra:  ".$fecha_compra_inicial .PHP_EOL);  
				    } 
				  }

				  if($empresa_compra != ""){
				  	$modelo_empresa = Empresa::model()->findByPk($empresa_compra);
						fwrite($txt_info, "Empresa de compra:  ".$modelo_empresa->Descripcion. PHP_EOL); 
				  }

				  if($tipos_equipo != ""){
				    $query .= " AND Tipo_Equipo IN (".$tipos_equipo.")";
				    $q_tipos_equipo = Yii::app()->db->createCommand("SELECT Dominio FROM TH_DOMINIO WHERE Id_Dominio IN (".$tipos_equipo.")")->queryAll(); 

				    $cadena_te = "";

				    foreach ($q_tipos_equipo as $tipo) {

					  	$cadena_te .= $tipo['Dominio'].", ";

					  }

					  fwrite($txt_info, "Tipo(s) de equipo:  ".substr($cadena_te, 0, -2). PHP_EOL);
			 	 		
				  }
				
				}

				$inc_licencias = explode(",", $inc_lic);

		  	if(in_array(1, $inc_licencias) && in_array(2, $inc_licencias)){
		  		fwrite($txt_info, "Incluir Licencias:  S.O, Office". PHP_EOL);
		  	}else{
		  		if(in_array(1, $inc_licencias) && !in_array(2, $inc_licencias)){
		  			fwrite($txt_info, "Incluir Licencias:  S.O". PHP_EOL);
		  		}else{
		  			if(!in_array(1, $inc_licencias) && in_array(2, $inc_licencias)){
		  				fwrite($txt_info, "Incluir Licencias:  Office". PHP_EOL);	
		  			}
		  		}
		  	}

				fclose($txt_info); 

				$rnd = rand(0,99999);
			  $id = $rnd;
			  $ruta_zip = Yii::app()->basePath.'/../zip/'.$id.'.zip';

			  //se declara un nuevo objeto ZIP
			  $zip = new ZipArchive(); 

			  $zip->open($ruta_zip, ZipArchive::CREATE);

	  		//se añade el directorio de equipos dentro del zip
			  $dir_equipos = 'equipos';
			  $zip->addEmptyDir($dir_equipos);

			  foreach ($array_equipos_soportes as $key => $value) {
			    
			    $soporte_equipo = $value;
			    $info_soporte_equipo = new SplFileInfo($soporte_equipo);
			    $ext = $info_soporte_equipo->getExtension();

			    $zip->addFile(Yii::app()->basePath.'/../images/docs_equipos_licencias/equipos/'.$value, $dir_equipos.'/'.trim($array_equipos_seriales[$key].'.'.$ext));

			  }

			  //S.O
			  if(!empty($array_so_soportes)){

		  		$dir_so = 'so';
		  		$zip->addEmptyDir($dir_so);

		  		$serial_so_act = "";

			  	foreach ($array_so_soportes as $key => $value) {
			    
				    $soporte_so = $value;
				    $info_soporte_so = new SplFileInfo($soporte_so);
				    $ext = $info_soporte_so->getExtension();

				    $serial_so = $array_so_seriales[$key];

				    if($serial_so == $serial_so_act){
				    	$zip->addFile(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$value, $dir_so.'/'.trim($array_so_seriales[$key].'_2.'.$ext));
				    }else{
				    	$zip->addFile(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$value, $dir_so.'/'.trim($array_so_seriales[$key].'.'.$ext));
				    }

				    $serial_so_act = $serial_so;

				  }
			  }

			  //Office
			  if(!empty($array_office_soportes)){

		  		$dir_office = 'office';
		  		$zip->addEmptyDir($dir_office);

		  		$serial_office_act = "";

			  	foreach ($array_office_soportes as $key => $value) {
			    
				    $soporte_office = $value;
				    $info_soporte_office = new SplFileInfo($soporte_office);
				    $ext = $info_soporte_office->getExtension();

				    $serial_office = $array_office_seriales[$key];

				    if($serial_office == $serial_office_act){
				    	$zip->addFile(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$value, $dir_office.'/'.trim($array_office_seriales[$key].'_2.'.$ext));
				    }else{
				    	$zip->addFile(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$value, $dir_office.'/'.trim($array_office_seriales[$key].'.'.$ext));
				    }

				    $serial_office_act = $serial_office;

				  }
			  }

			  //se añade txt con info de los filtros aplicados en el reporte
			  $zip->addFile(Yii::app()->basePath.'/../zip/filtro_busqueda.txt', 'filtro_busqueda.txt');
	 
			  //se cierra el zip
			  $zip->close();

			  //se elimina el archivos con info de los filtros de la carpeta temporal
			  unlink(Yii::app()->basePath.'/../zip/filtro_busqueda.txt');

				$resp = 1;
				$msg = "Zip generado correctamente.";
				$ruta = "/paneladm/zip/".$id.".zip";
				$archivo = "Soportes_".date('Y-m-d H_i_s').".zip";
				$resp = array('resp' => $resp, 'msg' => $msg, 'ruta' => $ruta, 'archivo' => $archivo);
		    echo json_encode($resp);
			}
		}
	}

	public function actionEstEquipos()
	{		
		$model=new Reporte;
		$model->scenario = 'est_equipos';

		$tipos_equipo= Yii::app()->db->createCommand('SELECT te.Id_Dominio, te.Dominio FROM TH_DOMINIO te WHERE te.Id_Padre = '.Yii::app()->params->tipo_equipo.' AND te.Estado = 1 ORDER BY te.Dominio')->queryAll();

		$empresas= Yii::app()->db->createCommand('SELECT e.Id_Empresa, e.Descripcion FROM TH_EMPRESA e WHERE e.Estado = 1 ORDER BY e.Descripcion')->queryAll();

		if(isset($_POST['Reporte']))
		{
			$model=$_POST['Reporte'];
			$this->renderPartial('est_equipos_resp',array('model' => $model));	
		}

		$this->render('est_equipos',array(
			'model'=>$model,
			'tipos_equipo'=>$tipos_equipo,
			'empresas'=>$empresas,
		));
	}

	public function actionEstEquiposPant()
	{		
		$empresa_compra = $_POST['empresa_compra'];
		$tipo_equipo = $_POST['tipo_equipo'];

		$resultados = UtilidadesReportes::estequipospantalla($empresa_compra, $tipo_equipo);
		echo $resultados;
	}

	public function actionLicEquipos()
	{		
		$model=new Reporte;
		$model->scenario = 'lic_equipos';

		$tipos_equipo= Yii::app()->db->createCommand('SELECT te.Id_Dominio, te.Dominio FROM TH_DOMINIO te WHERE te.Id_Padre = '.Yii::app()->params->tipo_equipo.' AND te.Estado = 1 ORDER BY te.Dominio')->queryAll();

		$empresas= Yii::app()->db->createCommand('SELECT e.Id_Empresa, e.Descripcion FROM TH_EMPRESA e WHERE e.Estado = 1 ORDER BY e.Descripcion')->queryAll();

		if(isset($_POST['Reporte']))
		{
			$model=$_POST['Reporte'];
			$this->renderPartial('lic_equipos_resp',array('model' => $model));	
		}

		$this->render('lic_equipos',array(
			'model'=>$model,
			'tipos_equipo'=>$tipos_equipo,
			'empresas'=>$empresas,
		));
	}

	public function actionLoadVersiones()
	{
		$tipo = $_POST['tipo'];
 
		$versiones = Yii::app()->db->createCommand("SELECT Id_Dominio, Dominio FROM TH_DOMINIO WHERE Id_Padre = '".$tipo."' AND Estado = 1 ORDER BY Dominio")->queryAll();

		$i = 0;
		$array_versiones = array();
		
		foreach ($versiones as $v) {
			$array_versiones[$i] = array('id' => $v['Id_Dominio'],  'text' => $v['Dominio']);
			$i++; 

		}
		
		//se retorna un json con las opciones
		echo json_encode($array_versiones);

	}

	public function actionLicEquiposPant()
	{		
		$empresa_compra = $_POST['empresa_compra'];
		$tipo_equipo = $_POST['tipo_equipo'];
		$tipo_licencia = $_POST['tipo_licencia'];
		$version = $_POST['version'];

		$resultados = UtilidadesReportes::licequipospantalla($empresa_compra, $tipo_equipo, $tipo_licencia, $version);
		echo $resultados;
	}

}
