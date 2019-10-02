<?php

class EquipoAutodeskController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($e)
	{
		$model=new EquipoAutodesk;

		$tipos_licencia=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_licencia, 'params'=>array(':estado'=>1)));

		$versiones_autodesk=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->version_autodesk, 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EquipoAutodesk']))
		{
			$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999
			$model->attributes=$_POST['EquipoAutodesk'];
 			
 			$model->Id_Equipo = $e;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

            $documento_subido = CUploadedFile::getInstance($model,'sop');
            $nombre_archivo = "{$rnd}-{$documento_subido}";
            $model->Doc_Soporte = $nombre_archivo;
 
            if($model->save()){
                $documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$nombre_archivo);
                $this->redirect(array('equipo/view','id'=>$e));
            }
		}

		$this->render('create',array(
			'model'=>$model,
			'e'=>$e,
			'tipos_licencia' => $tipos_licencia,
			'versiones_autodesk' => $versiones_autodesk,
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

		$tipos_licencia=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_licencia, 'params'=>array(':estado'=>1)));

		$versiones_autodesk=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->version_autodesk, 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$model=$this->loadModel($id);

		$ruta_doc_actual = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$model->Doc_Soporte;
		$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EquipoAutodesk']))
		{
			if($_FILES['EquipoAutodesk']['name']['sop']  != "") {

		        $documento_subido = CUploadedFile::getInstance($model,'sop');
	            $nombre_archivo = "{$rnd}-{$documento_subido}";
            	$model->Doc_Soporte = $nombre_archivo;
	            $opc = 1;
		    } 

			$model->attributes=$_POST['EquipoAutodesk'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
 
            if($model->save()){
            	if($opc == 1){
            		if (file_exists($ruta_doc_actual)) {
            			unlink($ruta_doc_actual);
            		}
                	$documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$nombre_archivo);
            	}
                $this->redirect(array('equipo/view','id'=>$model->Id_Equipo));
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'e'=>$model->Id_Equipo,
			'tipos_licencia' => $tipos_licencia,
			'versiones_autodesk' => $versiones_autodesk,
			'empresas'=>$empresas,
			'proveedores'=>$proveedores,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EquipoAutodesk the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EquipoAutodesk::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EquipoAutodesk $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipo-autodesk-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
