<?php

/**
 * This is the model class for table "TH_PC_ACT_PROCESO".
 *
 * The followings are the available columns in table 'TH_PC_ACT_PROCESO':
 * @property integer $Id_Pc_Act_Proceso
 * @property integer $Id_Proceso
 * @property string $Fecha_Inicial
 * @property string $Fecha_Final
 * @property string $Observaciones
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 *
 * The followings are the available model relations:
 * @property THPCPROCJUR $idProceso
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class PcActProceso extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PC_ACT_PROCESO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Proceso, Fecha_Inicial, Fecha_Final, Observaciones, Estado', 'required'),
			array('Id_Proceso, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Pc_Act_Proceso, Id_Proceso, Fecha_Inicial, Fecha_Final, Observaciones, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, usuario_creacion, usuario_actualizacion, orderby', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idproceso' => array(self::BELONGS_TO, 'PcProcJur', 'Id_Proceso'),
			'idusuarioact' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Actualizacion'),
			'idusuariocre' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Creacion'),
		);
	}

	public function Desc_Proceso($id_proceso){

		$modelo_proc = PcProcJur::model()->findByPk($id_proceso);
		return $modelo_proc->Id_Pc_Proc_Jur.' / '.$modelo_proc->Demandante.' - '.$modelo_proc->Demandados;

    }

    public function searchByProceso($filtro) {
        
        $resp = Yii::app()->db->createCommand("
		    SELECT TOP 10 Id_Pc_Proc_Jur, CONCAT (Id_Pc_Proc_Jur, ' / ', Demandante, ' - ', Demandados) AS Descr FROM TH_PC_PROC_JUR WHERE (Demandante LIKE '%".$filtro."%' OR Demandados  LIKE '%".$filtro."%' ) ORDER BY DESCR 
		")->queryAll();
        return $resp;
        
 	}

 	public function searchById($filtro) {
 
        $resp = Yii::app()->db->createCommand("
		    SELECT Id_Pc_Proc_Jur, CONCAT (Id_Pc_Proc_Jur, ' / ', Demandante, ' - ', Demandados) AS Descr FROM TH_PC_PROC_JUR WHERE Id_Pc_Proc_Jur = ".$filtro)->queryAll();
        return $resp;

 	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_Pc_Act_Proceso' => 'ID',
			'Id_Proceso' => 'Proceso (ID / Demandante - Demandados)',
			'Fecha_Inicial' => 'Fecha inicial',
			'Fecha_Final' => 'Fecha final',
			'Observaciones' => 'Observaciones',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario_creacion' => 'Usuario que creo',
			'usuario_actualizacion' => 'Usuario que actualizó',
			'orderby' => 'Orden de resultados',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->together  =  true;
		$criteria->with=array('idproceso');

	    $criteria->compare('Id_Pc_Act_Proceso',$this->Id_Pc_Act_Proceso);

	    if($this->Id_Proceso != ""){
			$criteria->AddCondition("t.Id_Proceso = '".$this->Id_Proceso."'"); 
	    }

	    if($this->Fecha_Inicial != ""){
      		$fci = $this->Fecha_Inicial." 00:00:00";
      		$fcf = $this->Fecha_Inicial." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Inicial', $fci, $fcf);
    	}

    	if($this->Fecha_Final != ""){
      		$fai = $this->Fecha_Final." 00:00:00";
      		$faf = $this->Fecha_Final." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Final', $fai, $faf);
    	}

	    $criteria->compare('t.Estado',$this->Estado);

	    if(empty($this->orderby)){
			$criteria->order = 't.Id_Pc_Act_Proceso DESC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Pc_Act_Proceso ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Pc_Act_Proceso DESC'; 
			        break;
			    case 3:
			        $criteria->order = 'idproceso.Demandante, idproceso.Demandados ASC'; 
			        break;
			    case 4:
			        $criteria->order = 'idproceso.Demandante, idproceso.Demandados DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Fecha_Inicial ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Fecha_Inicial DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Fecha_Final ASC'; 
			        break;
			    case 8:
			        $criteria->order = 't.Fecha_Final DESC'; 
			        break;
			    case 9:
			        $criteria->order = 't.Estado DESC'; 
			        break;
			    case 10:
			        $criteria->order = 't.Estado ASC'; 
			        break;
			}
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize'=>Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize'])),		
		));
	}

	/**
	 * Retrieveseturns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PcActProceso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
