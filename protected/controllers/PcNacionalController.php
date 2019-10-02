<?php

class PcNacionalController extends Controller
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
				'actions'=>array('admin','admincom','adminadm','adminfis','adminreg','adminlab','delete','viewres'),
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
		$model=new PcNacional;

		$areas=Area::model()->findAll(array('order'=>'Area', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->periodicidad, 'params'=>array(':estado'=>1)));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcNacional']))
		{
			$model->attributes=$_POST['PcNacional'];
			$model->Tipo = $tipo;
			$model->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Creacion = date('Y-m-d H:i:s');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');

			if($model->save())

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

		$this->render('create',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
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
		$model=$this->loadModel($id);

		$areas=Area::model()->findAll(array('order'=>'Area', 'condition'=>'Estado=:estado', 'params'=>array(':estado'=>1)));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Estado=:estado AND Tipo = '.Yii::app()->params->empresa_nac, 'params'=>array(':estado'=>1)));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->periodicidad, 'params'=>array(':estado'=>1)));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcNacional']))
		{
			$model->attributes=$_POST['PcNacional'];
			$model->Id_Usuario_Actualizacion = Yii::app()->user->getState('id_user');
			$model->Fecha_Actualizacion = date('Y-m-d H:i:s');
			if($model->save())
				
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

		$this->render('update',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
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
		$dataProvider=new CActiveDataProvider('PcNacional');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */


	public function actionAdmin()
	{

		$model=new PcNacional('search');

		$areas=Area::model()->findAll(array('order'=>'Area'));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$tipos=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Estado=:estado AND Id_Padre = '.Yii::app()->params->tipo_pc, 'params'=>array(':estado'=>1)));

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PcNacional']))
			$model->attributes=$_GET['PcNacional'];

		$this->render('admin',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
			'tipos'=>$tipos,
		));
	}

	public function actionAdminCom()
	{

		$model=new PcNacional('searchcom');

		$areas=Area::model()->findAll(array('order'=>'Area'));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacional']))
			$model->attributes=$_GET['PcNacional'];

		$this->render('admincom',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
			'tipo'=>Yii::app()->params->pc_comercial,
		));
	}

	public function actionAdminAdm()
	{

		$model=new PcNacional('searchadm');

		$areas=Area::model()->findAll(array('order'=>'Area'));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacional']))
			$model->attributes=$_GET['PcNacional'];

		$this->render('adminadm',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
			'tipo'=>Yii::app()->params->pc_administrativo,
		));
	}

	public function actionAdminFis()
	{

		$model=new PcNacional('searchfis');

		$areas=Area::model()->findAll(array('order'=>'Area'));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacional']))
			$model->attributes=$_GET['PcNacional'];

		$this->render('adminfis',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
			'tipo'=>Yii::app()->params->pc_fiscal,
		));
	}

	public function actionAdminReg()
	{

		$model=new PcNacional('searchreg');

		$areas=Area::model()->findAll(array('order'=>'Area'));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacional']))
			$model->attributes=$_GET['PcNacional'];

		$this->render('adminreg',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
			'tipo'=>Yii::app()->params->pc_regulatorio,
		));
	}

	public function actionAdminLab()
	{

		$model=new PcNacional('searchlab');

		$areas=Area::model()->findAll(array('order'=>'Area'));

		$empresas=Empresa::model()->findAll(array('order'=>'Descripcion', 'condition'=>'Tipo = '.Yii::app()->params->empresa_nac));

		$period=Dominio::model()->findAll(array('order'=>'Dominio', 'condition'=>'Id_Padre = '.Yii::app()->params->periodicidad));

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['PcNacional']))
			$model->attributes=$_GET['PcNacional'];

		$this->render('adminlab',array(
			'model'=>$model,
			'areas'=>$areas,
			'empresas'=>$empresas,
			'period'=>$period,
			'tipo'=>Yii::app()->params->pc_laboral,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PcNacional the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PcNacional::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PcNacional $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pc-nacional-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionViewRes($opc)
	{		
		
		if($opc == 1){
			//panel de control nacional (comercial)	
			$titulo ='<h3>Resumen panel de control nacional (Comercial)</h3>';
			$modeloconalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_comercial);
			$numconalerta = count ($modeloconalerta);
			$modelosinalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_comercial);
			$numsinalerta = count ($modelosinalerta);
			$modeloinactivos=PcNacional::model()->findAll("Estado = 0 AND Tipo = ".Yii::app()->params->pc_comercial);
			$numinactivos = count ($modeloinactivos);
		}

		if($opc == 2){
			//panel de control nacional (administrativo)	
			$titulo ='<h3>Resumen panel de control nacional (Administrativo)</h3>';
			$modeloconalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_administrativo);
			$numconalerta = count ($modeloconalerta);
			$modelosinalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_administrativo);
			$numsinalerta = count ($modelosinalerta);
			$modeloinactivos=PcNacional::model()->findAll("Estado = 0 AND Tipo = ".Yii::app()->params->pc_administrativo);
			$numinactivos = count ($modeloinactivos);
		}

		if($opc == 3){
			//panel de control nacional (fiscal)	
			$titulo ='<h3>Resumen panel de control nacional (Fiscal)</h3>';
			$modeloconalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_fiscal);
			$numconalerta = count ($modeloconalerta);
			$modelosinalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_fiscal);
			$numsinalerta = count ($modelosinalerta);
			$modeloinactivos=PcNacional::model()->findAll("Estado = 0 AND Tipo = ".Yii::app()->params->pc_fiscal);
			$numinactivos = count ($modeloinactivos);
		}

		if($opc == 4){
			//panel de control nacional (regulatorio)	
			$titulo ='<h3>Resumen panel de control nacional (Regulatorio)</h3>';
			$modeloconalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_regulatorio);
			$numconalerta = count ($modeloconalerta);
			$modelosinalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_regulatorio);
			$numsinalerta = count ($modelosinalerta);
			$modeloinactivos=PcNacional::model()->findAll("Estado = 0 AND Tipo = ".Yii::app()->params->pc_regulatorio);
			$numinactivos = count ($modeloinactivos);
		}

		if($opc == 5){
			//panel de control nacional (laboral)	
			$titulo ='<h3>Resumen panel de control nacional (Laboral)</h3>';
			$modeloconalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_laboral);
			$numconalerta = count ($modeloconalerta);
			$modelosinalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1 AND Tipo = ".Yii::app()->params->pc_laboral);
			$numsinalerta = count ($modelosinalerta);
			$modeloinactivos=PcNacional::model()->findAll("Estado = 0 AND Tipo = ".Yii::app()->params->pc_laboral);
			$numinactivos = count ($modeloinactivos);
		}

		if($opc == 6){
			//panel de control nacional (consolidado)
			$titulo ='<h3>Resumen panel de control nacional (Consolidado)</h3>';
			$modeloconalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) < Dias_Alerta AND Estado = 1");
			$numconalerta = count ($modeloconalerta);
			$modelosinalerta=PcNacional::model()->findAll("DATEDIFF(day,'".date('Y-m-d')."',Fecha_Final) >= Dias_Alerta AND Estado = 1");
			$numsinalerta = count ($modelosinalerta);
			$modeloinactivos=PcNacional::model()->findAll("Estado = 0");
			$numinactivos = count ($modeloinactivos);

		}

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
