<?php

/**
 * This is the model class for table "TH_PC_REGISTRO".
 *
 * The followings are the available columns in table 'TH_PC_REGISTRO':
 * @property integer $Id_Pc_Registro
 * @property integer $Empresa
 * @property string $Marca
 * @property string $Fecha_Inicial
 * @property string $Fecha_Final
 * @property string $Descripcion
 * @property string $Origen
 * @property string $Variedad_Registro
 * @property string $Expediente
 * @property string $Evidencia_Cumplimiento
 * @property string $Observaciones
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 * @property integer $Dias_Alerta
 *
 * The followings are the available model relations:
 * @property THEMPRESA $empresa
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 * @property THPCREGISTROANEXO[] $tHPCREGISTROANEXOs
 */
class PcRegistro extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;
	public $doc;
	public $num_anex;
	public $view;



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PC_REGISTRO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Empresa, Marca, Fecha_Inicial, Fecha_Final, Descripcion, Origen, Variedad_Registro, Expediente, Evidencia_Cumplimiento, Observaciones, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, Dias_Alerta', 'required'),
			array('Empresa, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion, Dias_Alerta', 'numerical', 'integerOnly'=>true),
			array('Marca, Origen, Expediente', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Pc_Registro, Empresa, Marca, Fecha_Inicial, Fecha_Final, Descripcion, Origen, Variedad_Registro, Expediente, Evidencia_Cumplimiento, Observaciones, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, Dias_Alerta, usuario_creacion, usuario_actualizacion, orderby, view', 'safe', 'on'=>'search'),
		);
	}

	public function Num_Anex($id_pc_reg){

		$modelo_act = PcRegistroAnexo::model()->findAllByAttributes(array('Id_Pc_Registro'=> $id_pc_reg, 'Estado' => 1));

		if(!empty($modelo_act)){	
			$num_act = count($modelo_act);
        	return $num_act;
		}else{
			return 0;
		}

    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idusuarioact' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Actualizacion'),
			'idusuariocre' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Creacion'),
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'Empresa'),
			'tHPCREGISTROANEXOs' => array(self::HAS_MANY, 'THPCREGISTROANEXO', 'Id_Pc_Registro'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_Pc_Registro' => 'ID',
			'Empresa' => 'Empresa',
			'Marca' => 'Marca',
			'Fecha_Inicial' => 'Fecha inicial',
			'Fecha_Final' => 'Fecha final',
			'Descripcion' => 'Descripción',
			'Origen' => 'Origen',
			'Variedad_Registro' => 'Variedad de registro',
			'Expediente' => 'Expediente',
			'Evidencia_Cumplimiento' => 'Evidencia Cumplimiento',
			'Estado' => 'Estado',
			'Observaciones' => 'Observaciones',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario_creacion' => 'Usuario que creo',
			'usuario_actualizacion' => 'Usuario que actualizó',
			'orderby' => 'Orden de resultados',
			'num_anex' => 'Anexos asociados',
			'Dias_Alerta'=>'Días de alerta (antelación)',
			'view'=>'Ver',
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
		$criteria->with=array('empresa');

		$criteria->compare('t.Id_Pc_Registro',$this->Id_Pc_Registro);

		if($this->Empresa != ""){
			$criteria->AddCondition("t.Empresa = '".$this->Empresa."'"); 
	    }

	    $criteria->compare('t.Marca',$this->Marca,true);
		$criteria->compare('t.Descripcion',$this->Descripcion,true);
		$criteria->compare('t.Origen',$this->Origen,true);
		
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

	    if(!empty($this->view)){
			switch ($this->view) {
			    case 1:
			        $criteria->AddCondition("DATEDIFF(day,'".date('Y-m-d')."',t.Fecha_Final) < t.Dias_Alerta AND t.Estado = 1");
			        break;
			    case 2:
			        $criteria->AddCondition("DATEDIFF(day,'".date('Y-m-d')."',t.Fecha_Final) >= t.Dias_Alerta AND t.Estado = 1"); 
			        break;
			    case 3:
			        $criteria->AddCondition("t.Estado = 0");
			        break;
			}			
		}

	    if(empty($this->orderby)){
			$criteria->order = 'empresa.Descripcion ASC , t.Marca ASC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Pc_Registro ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Pc_Registro DESC'; 
			        break;
			    case 3:
			        $criteria->order = 'empresa.Descripcion ASC'; 
			        break;
			    case 4:
			        $criteria->order = 'empresa.Descripcion DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Marca ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Marca DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Origen ASC'; 
			        break;
			    case 8:
			        $criteria->order = 't.Origen DESC'; 
			        break;
			    case 9:
			        $criteria->order = 't.Descripcion ASC'; 
			        break;
			    case 10:
			        $criteria->order = 't.Descripcion DESC'; 
			        break;
			    case 11:
			        $criteria->order = 't.Fecha_Inicial ASC'; 
			        break;
			    case 12:
			        $criteria->order = 't.Fecha_Inicial DESC'; 
			        break; 
			    case 13:
			        $criteria->order = 't.Fecha_Final DESC'; 
			        break;
			    case 14:
			        $criteria->order = 't.Fecha_Final ASC'; 
			        break;
			}
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize'=>Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize'])),		
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PcRegistro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
