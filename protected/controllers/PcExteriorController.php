<?php

class PcExteriorController extends Controller
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
				'actions'=>array('create','update','viewres'),
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
		$model=new PcExterior;

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_int, 'params'=>array(':estado'=>1)));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->periodicidad, 'params'=>array(':estado'=>1)));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcExterior']))
		{

			$model->attributes=$_POST['PcExterior'];
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
			'empresas'=>$empresas,
			'period'=>$period,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_int, 'params'=>array(':estado'=>1)));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->periodicidad, 'params'=>array(':estado'=>1)));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcExterior']))
		{
			$model->attributes=$_POST['PcExterior'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'empresas'=>$empresas,
			'period'=>$period,
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
		$dataProvider=new CActiveDataProvider('PcExterior');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new PcExterior('search');

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_int));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PcExterior']))
			$model->attributes=$_GET['PcExterior'];

		$this->render('admin',array(
			'model'=>$model,
			'empresas'=>$empresas,
			'period'=>$period,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PcExterior the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PcExterior::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PcExterior $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pc-exterior-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionViewRes()
	{		
		
		//panel de control exterior
		$titulo ='<h3>Resumen panel de control exterior</h3>';
		$modeloconalerta=PcExterior::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1");
		$numconalerta = count ($modeloconalerta);
		$modelosinalerta=PcExterior::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1");
		$numsinalerta = count ($modelosinalerta);
		$modeloinactivos=PcExterior::model()->findAll("Estado = 0");
		$numinactivos = count ($modeloinactivos);


		//se imprimen los parametros para mostrar la alerta

		echo $titulo;

		if($numconalerta == 0 && $numsinalerta == 0 && $numinactivos == 0){

			echo '
		    <div class="info-box bg-blue">
		        	<span class="info-box-icon"><i class="fa fa-info"></i></span>
		        <div class="info-box-content">
		          	<br>
		          	<span class="info-box-number">No hay registros.</span>
		      	  	<br>
		        </div>
		    </div>';

		}else{

			if($numconalerta > 0){
				echo '
			    <div class="info-box bg-red">
			        	<span class="info-box-icon"><i class="fa fa-exclamation-triangle"></i></span>
			        <div class="info-box-content">
			          	<span class="info-box-number">'.$numconalerta.' Registro(s) fuera de termino</span>
			      	  	<br>
			       	  	<button class="btn btn-default" onclick="filtro(1)">Ver registro(s)</button>
			        </div>
			    </div>';
			}

			if($numsinalerta > 0){
				echo '
			    <div class="info-box bg-green">
			        	<span class="info-box-icon"><i class="fa fa-check"></i></span>
			        <div class="info-box-content">
			          	<span class="info-box-number">'.$numsinalerta.' Registro(s) sin alerta</span>
			      	  	<br>
			       	  	<button class="btn btn-default" onclick="filtro(2)">Ver registro(s)</button>
			        </div>
			    </div>';
			}

			if($numinactivos > 0){
				echo '
			    <div class="info-box bg-gray">
			        	<span class="info-box-icon"><i class="fa fa-power-off"></i></span>
			        <div class="info-box-content">
			          	<span class="info-box-number">'.$numinactivos.' Registro(s) inactivo(s)</span>
			      	  	<br>
			       	  	<button class="btn btn-default" onclick="filtro(3)">Ver registro(s)</button>
			        </div>
			    </div>';
			}
		}
	}

}
