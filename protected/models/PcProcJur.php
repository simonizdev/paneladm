<?php

/**
 * This is the model class for table "TH_PC_PROC_JUR".
 *
 * The followings are the available columns in table 'TH_PC_PROC_JUR':
 * @property integer $Id_Pc_Proc_Jur
 * @property string $Demandante
 * @property string $Demandados
 * @property string $Abogado
 * @property string $Tipo_Proceso
 * @property string $Fecha_Admision
 * @property string $Fecha_Contestacion
 * @property string $Radicado
 * @property string $Autoridad
 * @property string $Observaciones
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 * @property integer $Estado
 * @property integer $Dias_Alerta
 *
 * The followings are the available model relations:
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class PcProcJur extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;
	public $num_act;
	public $view;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PC_PROC_JUR';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Demandante, Demandados, Abogado, Tipo_Proceso, Fecha_Admision, Fecha_Contestacion, Radicado, Autoridad, Observaciones, Estado, Dias_Alerta', 'required'),
			array('Id_Usuario_Creacion, Id_Usuario_Actualizacion, Estado, Dias_Alerta', 'numerical', 'integerOnly'=>true),
			array('Demandante, Abogado, Tipo_Proceso, Autoridad', 'length', 'max'=>100),
			array('Demandados', 'length', 'max'=>300),
			array('Radicado', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Pc_Proc_Jur, Demandante, Demandados, Abogado, Tipo_Proceso, Fecha_Admision, Fecha_Contestacion, Radicado, Autoridad, Observaciones, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, usuario_creacion, usuario_actualizacion, orderby, view', 'safe', 'on'=>'search'),
		);
	}

	public function Num_Act($id_proceso){

		$modelo_act = PcActProceso::model()->findAllByAttributes(array('Id_Proceso'=> $id_proceso, 'Estado' => 1));

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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_Pc_Proc_Jur' => 'ID',
			'Demandante' => 'Demandante',
			'Demandados' => 'Demandados',
			'Abogado' => 'Abogado',
			'Tipo_Proceso' => 'Tipo proceso',
			'Fecha_Admision' => 'Fecha admisión',
			'Fecha_Contestacion' => 'Fecha contestación',
			'Radicado' => 'Radicado',
			'Autoridad' => 'Autoridad',
			'Observaciones' => 'Observaciones',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario_creacion' => 'Usuario que creo',
			'usuario_actualizacion' => 'Usuario que actualizó',
			'orderby' => 'Orden de resultados',
			'num_act' => 'Act. asociadas',
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

		$criteria->compare('Id_Pc_Proc_Jur',$this->Id_Pc_Proc_Jur);
		$criteria->compare('Demandante',$this->Demandante,true);
		$criteria->compare('Demandados',$this->Demandados,true);
		$criteria->compare('Abogado',$this->Abogado,true);
		$criteria->compare('Tipo_Proceso',$this->Tipo_Proceso,true);

		if($this->Fecha_Admision != ""){
      		$fci = $this->Fecha_Admision." 00:00:00";
      		$fcf = $this->Fecha_Admision." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Admision', $fci, $fcf);
    	}

    	if($this->Fecha_Contestacion != ""){
      		$fai = $this->Fecha_Contestacion." 00:00:00";
      		$faf = $this->Fecha_Contestacion." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Contestacion', $fai, $faf);
    	}

		if(!empty($this->view)){
			switch ($this->view) {
			    case 1:
			        $criteria->AddCondition("DATEDIFF(day,'".date('Y-m-d')."',t.Fecha_Contestacion) < t.Dias_Alerta AND t.Estado = 1");
			        break;
			    case 2:
			        $criteria->AddCondition("DATEDIFF(day,'".date('Y-m-d')."',t.Fecha_Contestacion) >= t.Dias_Alerta AND t.Estado = 1"); 
			        break;
			    case 3:
			        $criteria->AddCondition("t.Estado = 0");
			        break;
			}			
		}

		if(empty($this->orderby)){
			$criteria->order = 't.Id_Pc_Proc_Jur DESC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Pc_Proc_Jur ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Pc_Proc_Jur DESC'; 
			        break;
			    case 3:
			        $criteria->order = 't.Demandante ASC'; 
			        break;
			    case 4:
			        $criteria->order = 't.Demandante DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Demandados ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Demandados DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Abogado ASC'; 
			        break;
			    case 8:
			        $criteria->order = 't.Abogado DESC'; 
			        break;
			    case 9:
			        $criteria->order = 't.Tipo_Proceso ASC'; 
			        break;
			    case 10:
			        $criteria->order = 't.Tipo_Proceso DESC'; 
			        break;
			    case 11:
			        $criteria->order = 't.Fecha_Admision ASC'; 
			        break;
			    case 12:
			        $criteria->order = 't.Fecha_Admision DESC'; 
			        break; 
			    case 13:
			        $criteria->order = 't.Fecha_Contestacion DESC'; 
			        break;
			    case 14:
			        $criteria->order = 't.Fecha_Contestacion ASC'; 
			        break;
			}
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PcProcJur the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
