<?php

class PcNacionalAnexoController extends Controller
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
				'actions'=>array('index','view','viewall'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','admincom','adminadm','adminfis','adminlab','adminreg','searchpcnacional','searchpcnacionalbyid'),
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
	public function actionView($id, $tipo)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'tipo'=>$tipo,
		));
	}

	public function actionViewAll($id)
	{
		$this->render('viewall',array(
			'model'=>$this->loadModel($id),
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($tipo)
	{
		$model=new PcNacionalAnexo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcNacionalAnexo']))
		{
			$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999
			$model->attributes=$_POST['PcNacionalAnexo'];
 			$model->Tipo = $tipo;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

            $documento_subido = CUploadedFile::getInstance($model,'doc');
            $nombre_archivo = "{$rnd}-{$documento_subido}";
            $model->Doc_Soporte = $nombre_archivo;
 
            if($model->save()){
                $documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_pc_nac/'.$nombre_archivo);
                switch ($tipo) {
				    case Yii::app()->params->pc_comercial:
			        	$this->redirect(array('admincom'));
				    case Yii::app()->params->pc_administrativo:
				        $this->redirect(array('adminadm')); 
				    case Yii::app()->params->pc_fiscal:
				        $this->redirect(array('adminfis')); 
				    case Yii::app()->params->pc_regulatorio:
				        $this->redirect(array('adminreg'));
				   	case Yii::app()->params->pc_laboral:
				        $this->redirect(array('adminlab'));
				}
            }
		}

		$this->render('create',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $tipo)
	{
		$opc = 0;

		$model=$this->loadModel($id);

		$ruta_doc_actual = Yii::app()->basePath.'/../images/docs_pc_nac/'.$model->Doc_Soporte;
		$rnd = rand(0,99999);  // genera un numero ramdom entre 0-99999

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcNacionalAnexo']))
		{
			if($_FILES['PcNacionalAnexo']['name']['doc']  != "") {

		        $documento_subido = CUploadedFile::getInstance($model,'doc');
	            $nombre_archivo = "{$rnd}-{$documento_subido}";
            	$model->Doc_Soporte = $nombre_archivo;
	            $opc = 1;
		    } 

			$model->attributes=$_POST['PcNacionalAnexo'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
 
            if($model->save()){
            	if($opc == 1){
            		unlink($ruta_doc_actual);
                	$documento_subido->saveAs(Yii::app()->basePath.'/../images/docs_pc_nac/'.$nombre_archivo);
            	}
                switch ($tipo) {
				    case Yii::app()->params->pc_comercial:
			        	$this->redirect(array('admincom'));
				    case Yii::app()->params->pc_administrativo:
				        $this->redirect(array('adminadm')); 
				    case Yii::app()->params->pc_fiscal:
				        $this->redirect(array('adminfis')); 
				    case Yii::app()->params->pc_regulatorio:
				        $this->redirect(array('adminreg'));
				    case Yii::app()->params->pc_laboral:
				        $this->redirect(array('adminlab'));
				}
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'tipo'=>$tipo,

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
		$dataProvider=new CActiveDataProvider('PcNacionalAnexo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PcNacionalAnexo('search');

		$tipos=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_pc, 'params'=>array(':estado'=>1)));

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PcNacionalAnexo']))
			$model->attributes=$_GET['PcNacionalAnexo'];

		$this->render('admin',array(
			'model'=>$model,
			'tipos'=>$tipos,
		));
	}

	public function actionAdminCom()
	{

		$model=new PcNacionalAnexo('searchcom');

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacionalAnexo']))
			$model->attributes=$_GET['PcNacionalAnexo'];

		$this->render('admincom',array(
			'model'=>$model,
			'tipo'=>Yii::app()->params->pc_comercial,
		));
	}

	public function actionAdminAdm()
	{

		$model=new PcNacionalAnexo('searchadm');

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacionalAnexo']))
			$model->attributes=$_GET['PcNacionalAnexo'];

		$this->render('adminadm',array(
			'model'=>$model,
			'tipo'=>Yii::app()->params->pc_administrativo,
		));
	}

	public function actionAdminFis()
	{

		$model=new PcNacionalAnexo('searchfis');

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacionalAnexo']))
			$model->attributes=$_GET['PcNacionalAnexo'];

		$this->render('adminfis',array(
			'model'=>$model,
			'tipo'=>Yii::app()->params->pc_fiscal,
		));
	}

	public function actionAdminReg()
	{

		$model=new PcNacionalAnexo('searchreg');

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacionalAnexo']))
			$model->attributes=$_GET['PcNacionalAnexo'];

		$this->render('adminreg',array(
			'model'=>$model,
			'tipo'=>Yii::app()->params->pc_regulatorio,
		));
	}

	public function actionAdminLab()
	{

		$model=new PcNacionalAnexo('searchlab');

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacionalAnexo']))
			$model->attributes=$_GET['PcNacionalAnexo'];

		$this->render('adminlab',array(
			'model'=>$model,
			'tipo'=>Yii::app()->params->pc_laboral,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PcNacionalAnexo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PcNacionalAnexo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PcNacionalAnexo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pc-nacional-anexo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSearchPcNacional(){
		$tipo = $_GET['tipo'];
		$filtro = $_GET['q'];
        $data = PcNacionalAnexo::model()->searchByPcNacional($tipo, $filtro);
        $result = array();
        foreach($data as $item):
           $result[] = array(
               'id'   => $item['Id_Pc_Nacional'],
               'text' => $item['Descr'],
           );
        endforeach;
        header('Content-type: application/json');
        echo CJSON::encode( $result );
        Yii::app()->end(); 
 	}

 	public function actionSearchPcNacionalById(){
		$filtro = $_GET['id'];
        $data = PcNacionalAnexo::model()->searchById($filtro);

        $result = array();
        foreach($data as $item):
           $result[] = array(
               'id'   => $item['Id_Pc_Nacional'],
               'text' => $item['Descr'],
           );
        endforeach;

        header('Content-type: application/json');
        echo CJSON::encode( $result );
        Yii::app()->end(); 
 	}
}
