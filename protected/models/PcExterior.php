<?php

/**
 * This is the model class for table "TH_PC_EXTERIOR".
 *
 * The followings are the available columns in table 'TH_PC_EXTERIOR':
 * @property integer $Id_Pc_Ext
 * @property integer $Empresa
 * @property string $Descripcion
 * @property integer $Periodicidad
 * @property string $Fecha_Inicial
 * @property string $Fecha_Final
 * @property string $Actividad
 * @property string $Area
 * @property string $Evidencia_Cumplimiento
 * @property integer $Estado
 * @property string $Observaciones
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 * @property integer $Dias_Alerta
 *
 * The followings are the available model relations:
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class PcExterior extends CActiveRecord
{
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;
	public $num_anex;
	public $view;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PC_EXTERIOR';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Empresa, Descripcion, Periodicidad, Fecha_Inicial, Fecha_Final, Actividad, Area, Evidencia_Cumplimiento, Estado, Observaciones, Dias_Alerta', 'required'),
			array('Empresa, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion, Dias_Alerta, Periodicidad', 'numerical', 'integerOnly'=>true),
			array('Descripcion, Area', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Pc_Ext, Empresa, Descripcion, Periodicidad, Fecha_Inicial, Fecha_Final, Actividad, Area, Evidencia_Cumplimiento, Observaciones, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, usuario_creacion, usuario_actualizacion, orderby, view', 'safe', 'on'=>'search'),
		);
	}

	public function Num_Anex($id_pc_ext){

		$modelo_act = PcExteriorAnexo::model()->findAllByAttributes(array('Id_Pc_Ext'=> $id_pc_ext, 'Estado' => 1));

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
			'periodicidad' => array(self::BELONGS_TO, 'Dominio', 'Periodicidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_Pc_Ext' => 'ID',
			'Empresa' => 'Empresa',
			'Descripcion' => 'Descripción',
			'Periodicidad' => 'Periodicidad',
			'Fecha_Inicial' => 'Fecha inicial',
			'Fecha_Final' => 'Fecha final',
			'Actividad' => 'Actividad',
			'Area' => 'Área',
			'Evidencia_Cumplimiento' => 'Evidencia cumplimiento',
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
		$criteria->with=array('periodicidad','empresa');

		$criteria->compare('t.Id_Pc_Ext',$this->Id_Pc_Ext);

		if($this->Empresa != ""){
			$criteria->AddCondition("t.Empresa = '".$this->Empresa."'"); 
	    }

		$criteria->compare('t.Descripcion',$this->Descripcion,true);

		if($this->Periodicidad != ""){
			$criteria->AddCondition("t.Periodicidad = '".$this->Periodicidad."'"); 
	    }

	    $criteria->compare('t.Area',$this->Area);
		
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
			$criteria->order = 'empresa.Descripcion ASC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Pc_Ext ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Pc_Ext DESC'; 
			        break;
			    case 3:
			        $criteria->order = 'empresa.Descripcion ASC'; 
			        break;
			    case 4:
			        $criteria->order = 'empresa.Descripcion DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Descripcion ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Descripcion DESC'; 
			        break;
			    case 7:
			        $criteria->order = 'periodicidad.Dominio ASC'; 
			        break;
			    case 8:
			        $criteria->order = 'periodicidad.Dominio DESC'; 
			        break;
			    case 9:
			        $criteria->order = 't.Area ASC'; 
			        break;
			    case 10:
			        $criteria->order = 't.Area DESC'; 
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
	 * @return PcExterior the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
