<?php

class EquipoOfficeController extends Controller
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
		$model=new EquipoOffice;

		$tipos_licencia=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_licencia, 'params'=>array(':estado'=>1)));

		$versiones_office=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->version_office, 'params'=>array(':estado'=>1)));

		$productos_office=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->producto_office, 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$opc = 0;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EquipoOffice']))
		{
			$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999
			$rnd2 = rand(0,99999);  // genera un numero ramdom entre 0-99999
			$model->attributes=$_POST['EquipoOffice'];
 			
 			$model->Id_Equipo = $e;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

            $documento_subido = CUploadedFile::getInstance($model,'sop');
            $nombre_archivo = "{$rnd}-{$documento_subido}";
            $model->Doc_Soporte = $nombre_archivo;

            if($_FILES['EquipoOffice']['name']['sop2']  != "") {

		        $documento_subido2 = CUploadedFile::getInstance($model,'sop2');
	            $nombre_archivo2 = "{$rnd2}-{$documento_subido2}";
            	$model->Doc_Soporte2 = $nombre_archivo2;
	            $opc = 1;
		    } 
 
            if($model->save()){
                $documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$nombre_archivo);

                if($opc == 1){
                	$documento_subido2->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$nombre_archivo2);
            	}

                $this->redirect(array('equipo/view','id'=>$e));
            }
		}

		$this->render('create',array(
			'model'=>$model,
			'e'=>$e,
			'tipos_licencia' => $tipos_licencia,
			'versiones_office' => $versiones_office,
			'productos_office' => $productos_office,
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
		$opc2 = 0;

		$tipos_licencia=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_licencia, 'params'=>array(':estado'=>1)));

		$versiones_office=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->version_office, 'params'=>array(':estado'=>1)));

		$productos_office=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->producto_office, 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$proveedores=Proveedor::model()->findAll(array('order'=>'Proveedor', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$model=$this->loadModel($id);

		$ruta_doc_actual = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$model->Doc_Soporte;
		$doc_actual2 = $model->Doc_Soporte2;
		$ruta_doc_actual2 = Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$model->Doc_Soporte2;
		$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999
		$rnd2 = rand(0,99999);  // genera un numero ramdom entre 0-99999

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EquipoOffice']))
		{
			if($_FILES['EquipoOffice']['name']['sop']  != "") {

		        $documento_subido = CUploadedFile::getInstance($model,'sop');
	            $nombre_archivo = "{$rnd}-{$documento_subido}";
            	$model->Doc_Soporte = $nombre_archivo;
	            $opc = 1;
		    }

		    if($_FILES['EquipoOffice']['name']['sop2']  != "") {

		        $documento_subido2 = CUploadedFile::getInstance($model,'sop2');
	            $nombre_archivo2 = "{$rnd2}-{$documento_subido2}";
            	$model->Doc_Soporte2 = $nombre_archivo2;
	            $opc2 = 1;
		    } 

			$model->attributes=$_POST['EquipoOffice'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
 
            if($model->save()){
            	
            	if($opc == 1){
            		if (file_exists($ruta_doc_actual)) {
            			unlink($ruta_doc_actual);
            		}
                	$documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$nombre_archivo);
            	}

            	if($opc2 == 1){
        			if ($doc_actual2 != "") {
            			unlink($ruta_doc_actual2);
            		}
                	$documento_subido2->saveAs(Yii::app()->basePath.'/../images/docs_equipos_licencias/licencias/'.$nombre_archivo2);
            	}

                $this->redirect(array('equipo/view','id'=>$model->Id_Equipo));
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'e'=>$model->Id_Equipo,
			'tipos_licencia' => $tipos_licencia,
			'versiones_office' => $versiones_office,
			'productos_office' => $productos_office,
			'empresas'=>$empresas,
			'proveedores'=>$proveedores,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EquipoOffice the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EquipoOffice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EquipoOffice $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipo-office-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
