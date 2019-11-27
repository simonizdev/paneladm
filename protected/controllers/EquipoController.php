<?php

class EquipoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'export', 'exportexcel'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		if($model->Estado == 1){
			$asociacion = 1;
		}else{
			$asociacion = 0;
		}

		//Licencias asociadas a equipo
		$licencias=new LicenciaEquipo('search');
		$licencias->unsetAttributes();  // clear any default values
		$licencias->Id_Equipo = $id;

		$this->render('view',array(
			'model'=> $model,
			'asociacion'=> $asociacion,
			'licencias'=> $licencias,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Equipo;

		$model->scenario = 'create';

		$tipos=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_equipo, 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Equipo']))
		{
			$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999
			$model->attributes=$_POST['Equipo'];
 			
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

            $documento_subido = CUploadedFile::getInstance($model,'sop');
            $nombre_archivo = "{$rnd}-{$documento_subido}";
            $model->Doc_Soporte = $nombre_archivo;
 
            if($model->save()){
                $documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/equipos/'.$nombre_archivo);
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
			'tipos'=>$tipos,
			'empresas'=>$empresas,
			'proveedores'=>$proveedores,
		));

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$opc = 0;

		$tipos=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_equipo, 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$model=$this->loadModel($id);

		$estado_act = $model->Estado;

		$model->scenario = 'update';

		$ruta_doc_actual = Yii::app()->basePath.'/../images/docs_equipos_licencias/equipos/'.$model->Doc_Soporte;
		$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Equipo']))
		{
			if($_FILES['Equipo']['name']['sop']  != "") {

		        $documento_subido = CUploadedFile::getInstance($model,'sop');
	            $nombre_archivo = "{$rnd}-{$documento_subido}";
            	$model->Doc_Soporte = $nombre_archivo;
	            $opc = 1;
		    } 

			$model->attributes=$_POST['Equipo'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
 
            if($model->save()){
            	if($opc == 1){
            		
            		if (file_exists($ruta_doc_actual)) {
            			unlink($ruta_doc_actual);
            		}

                	$documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/equipos/'.$nombre_archivo);
            	}

            	if($estado_act != $model->Estado && $model->Estado == 0){
        			//se inactivan las licencias de clasif. S.O
        			$model_lic = LicenciaEquipo::model()->findAllByAttributes(array('Id_Equipo' => $id, 'Estado' => 1));
        			if(!empty($model_lic)){
            			foreach ($model_lic as $reg) {
            				if($reg->idlicencia->Clasificacion == Yii::app()->params->clase_licencia_so && $reg->idlicencia->Tipo == Yii::app()->params->tipo_licencia_oem){
            					
            					$reg->Estado = 0;
            					$reg->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
								$reg->Fecha_Actualizacion = date('Y-m-d H:i:s');
								$reg->save();
            				
								$licencia = Licencia::model()->findByPk($reg->Id_Licencia);
								$licencia->Estado = Yii::app()->params->estado_lic_ina;
            					$licencia->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
								$licencia->Fecha_Actualizacion = date('Y-m-d H:i:s');
								$licencia->save();
							
            				}
            			}
            		}
        		}


                $this->redirect(array('admin'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'tipos'=>$tipos,
			'empresas'=>$empresas,
			'proveedores'=>$proveedores,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Equipo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		if(Yii::app()->request->getParam('export')) {
    		$this->actionExport();
    		Yii::app()->end();
		}

		$model=new Equipo('search');

		$tipos=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->tipo_equipo));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor'));

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Equipo']))
			$model->attributes=$_GET['Equipo'];

		$this->render('admin',array(
			'model'=>$model,
			'tipos'=>$tipos,
			'empresas'=>$empresas,
			'proveedores'=>$proveedores,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Equipo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Equipo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Equipo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExport(){
    	
    	$model=new Equipo('search');
	    $model->unsetAttributes();  // clear any default values
	    
	    if(isset($_GET['Equipo'])) {
	        $model->attributes=$_GET['Equipo'];
	    }

    	$dp = $model->search();
		$dp->setPagination(false);
 
		$data = $dp->getData();

		Yii::app()->user->setState('equipo-export',$data);
	}

	public function actionExportExcel()
	{
		$data = Yii::app()->user->getState('equipo-export');
		$this->renderPartial('equipo_export_excel',array('data' => $data));	
	}
}
