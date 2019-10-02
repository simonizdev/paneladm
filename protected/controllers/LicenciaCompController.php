<?php

class LicenciaCompController extends Controller
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
				'actions'=>array('create','update'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new LicenciaComp;

		$model->scenario = 'create';

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LicenciaComp']))
		{
			$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999
			$model->attributes=$_POST['LicenciaComp'];
 			
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

            $documento_subido = CUploadedFile::getInstance($model,'sop');
            $nombre_archivo = "{$rnd}-{$documento_subido}";
            $model->Doc_Soporte = $nombre_archivo;
 
            if($model->save()){
                $documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias_comp/'.$nombre_archivo);
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
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

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$model=$this->loadModel($id);

		$model->scenario = 'update';

		$ruta_doc_actual = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias_comp/'.$model->Doc_Soporte;
		$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LicenciaComp']))
		{
			if($_FILES['LicenciaComp']['name']['sop']  != "") {

		        $documento_subido = CUploadedFile::getInstance($model,'sop');
	            $nombre_archivo = "{$rnd}-{$documento_subido}";
            	$model->Doc_Soporte = $nombre_archivo;
	            $opc = 1;
		    } 

			$model->attributes=$_POST['LicenciaComp'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
 
            if($model->save()){
            	if($opc == 1){
            		unlink($ruta_doc_actual);
                	$documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias_comp/'.$nombre_archivo);
            	}
                $this->redirect(array('admin'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('LicenciaComp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LicenciaComp('search');

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor'));

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LicenciaComp']))
			$model->attributes=$_GET['LicenciaComp'];

		$this->render('admin',array(
			'model'=>$model,
			'empresas'=>$empresas,
			'proveedores'=>$proveedores,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LicenciaComp the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LicenciaComp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LicenciaComp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='licencia-comp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
