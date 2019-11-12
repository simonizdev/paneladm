<?php

class LicenciaEquipoController extends Controller
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
				'actions'=>array('create','create2','searchlicenciaasocequipo','searchequipoasoclicencia','inact'),
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
	public function actionCreate($e)
	{
		$model=new LicenciaEquipo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LicenciaEquipo']))
		{
			$model->attributes=$_POST['LicenciaEquipo'];
			$model->Id_Equipo = $e;
			$model->Estado = 1;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
			
			if($model->save()){

				$model_licencia = New Licencia;
        		$desc_licencia = $model_licencia->DescLicencia($model->Id_Licencia);

				Yii::app()->user->setFlash('success', "Se vinculo la licencia ".$desc_licencia." correctamente.");
				$this->redirect(array('equipo/view','id'=>$e));
			}else{
				Yii::app()->user->setFlash('warning', "No se pudo vincular la licencia ".$desc_licencia.".");
				$this->redirect(array('equipo/view','id'=>$e));
			}

		}

		$this->render('create',array(
			'model'=>$model,
			'e'=>$e,
		));
	}

	public function actionCreate2($l)
	{
		$model=new LicenciaEquipo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LicenciaEquipo']))
		{
			$model->attributes=$_POST['LicenciaEquipo'];
			$model->Id_Licencia = $l;
			$model->Estado = 1;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
			
			if($model->save()){

        		$desc_equipo = UtilidadesVarias::descequipo($model->Id_Equipo);

				Yii::app()->user->setFlash('success', "Se vinculo el equipo ".$desc_equipo." correctamente.");
				$this->redirect(array('licencia/view','id'=>$l));
			}else{
				Yii::app()->user->setFlash('warning', "No se pudo vincular el equipo ".$desc_equipo.".");
				$this->redirect(array('licencia/view','id'=>$l));
			}

		}

		$this->render('create2',array(
			'model'=>$model,
			'l'=>$l,
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
		$dataProvider=new CActiveDataProvider('LicenciaEquipo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LicenciaEquipo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LicenciaEquipo']))
			$model->attributes=$_GET['LicenciaEquipo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LicenciaEquipo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LicenciaEquipo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LicenciaEquipo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='licencia-equipo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSearchLicenciaAsocEquipo(){
		$filtro = $_GET['q'];
		$e = $_GET['e'];
        $data = LicenciaEquipo::model()->searchByLicenciaAsocEquipo($filtro, $e);
        $result = array();
        foreach($data as $reg):

        	$model_licencia = New Licencia;
        	$desc_licencia = $model_licencia->DescLicencia($reg['Id_Lic']);
        	$lic_rest = $model_licencia->CantUsuariosRest($reg['Id_Lic']);

           	$result[] = array(
               'id'   => $reg['Id_Lic'],
               'text' => $desc_licencia.' / '.$lic_rest.' Rest.',
           	);
        endforeach;
        header('Content-type: application/json');
        echo CJSON::encode( $result );
        Yii::app()->end(); 
 	}

 	public function actionSearchEquipoAsocLicencia(){
		$filtro = $_GET['q'];
		$l = $_GET['l'];
        $data = LicenciaEquipo::model()->searchByEquipoAsocLicencia($filtro, $l);
        $result = array();
        foreach($data as $reg):

        	$desc_equipo = UtilidadesVarias::descequipo($reg['Id_Equipo']);

           	$result[] = array(
               'id'   => $reg['Id_Equipo'],
               'text' => $desc_equipo,
           	);
        endforeach;
        header('Content-type: application/json');
        echo CJSON::encode( $result );
        Yii::app()->end(); 
 	}

 	public function actionInact($id, $opc)
	{
		
		$model=$this->loadModel($id);

		$model_licencia = New Licencia;
        $desc_licencia = $model_licencia->DescLicencia($model->Id_Licencia);
		$desc_equipo = UtilidadesVarias::descequipo($model->Id_Equipo);

		
		$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
		$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
		$model->Estado = 0;
		
		if($model->save()){
			
			if($opc == 1){
				//consulta licencia
				Yii::app()->user->setFlash('success', "Se desvinculo el equipo ".$desc_equipo." correctamente.");
				$this->redirect(array('licencia/view','id'=>$model->Id_Licencia));	
			}else{
				//por equipo
				Yii::app()->user->setFlash('success', "Se desvinculo la licencia ".$desc_licencia." correctamente.");
				$this->redirect(array('equipo/view','id'=>$model->Id_Equipo));	
			}

		}else{

			if($opc == 1){
				//consulta licencia
				Yii::app()->user->setFlash('warning', "no se pudo desvincular el equipo ".$desc_equipo.".");
				$this->redirect(array('licencia/view','id'=>$model->Id_Licencia));	
			}else{
				//por equipo
				Yii::app()->user->setFlash('warning', "no se pudo desvincular la licencia ".$desc_licencia.".");
				$this->redirect(array('equipo/view','id'=>$model->Id_Equipo));
			}

		}

	}
}
