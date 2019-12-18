<?php

class ItemContController extends Controller
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
		//items asociados a contrato
		$historial=new HistItemCont('search');
		$historial->unsetAttributes();  // clear any default values
		$historial->Id_Item = $id;

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'historial'=>$historial,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($c)
	{
		$model=new ItemCont;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemCont']))
		{
			$model->attributes=$_POST['ItemCont'];
 			$model->Id_Contrato = $c;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
 
            if($model->save()){
            	Yii::app()->user->setFlash('success', "Se asocio el item (".$model->Item.") correctamente.");
				$this->redirect(array('cont/view','id'=>$c));
			}else{
				Yii::app()->user->setFlash('warning', "No se pudo asociar el item.");
				$this->redirect(array('cont/view','id'=>$c));
			}

		}

		$this->render('create',array(
			'model'=>$model,
			'c'=>$c,
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

		$item_act = $model->Item;
		$descripcion_act = $model->Descripcion;
		$cant_act = $model->Cant;
		$vlr_unit_act = $model->Vlr_Unit;
		$estado_act = $model->Estado;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemCont']))
		{
			$model->attributes=$_POST['ItemCont'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
			if($model->save()){
				
				//función para registrar cambios en las Cuentas
				UtilidadesVarias::novedaditem(
					$id,  
					$item_act, 
					$model->Item,
					$descripcion_act, 
					$model->Descripcion,
					$cant_act, 
					$model->Cant,
					$vlr_unit_act, 
					$model->Vlr_Unit,
					$estado_act, 
					$model->Estado,
				);


				Yii::app()->user->setFlash('success', "Se actualizo el item correctamente.");
				$this->redirect(array('cont/view','id'=>$model->Id_Contrato));
			
			}else{
				Yii::app()->user->setFlash('warning', "No se pudo actualizar el item.");
				$this->redirect(array('cont/view','id'=>$model->Id_Contrato));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'c'=>$model->Id_Contrato,
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
		$dataProvider=new CActiveDataProvider('ItemCont');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ItemCont('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ItemCont']))
			$model->attributes=$_GET['ItemCont'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ItemCont the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ItemCont::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ItemCont $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-cont-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
