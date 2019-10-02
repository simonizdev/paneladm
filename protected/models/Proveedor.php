<?php

/**
 * This is the model class for table "TH_PROVEEDOR".
 *
 * The followings are the available columns in table 'TH_PROVEEDOR':
 * @property integer $Id_Proveedor
 * @property string $Proveedor
 * @property string $Tel
 * @property string $Observaciones
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 *
 * The followings are the available model relations:
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 * @property THEQUIPO[] $tHEQUIPOs
 */
class Proveedor extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PROVEEDOR';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Proveedor, Tel, Observaciones, Estado', 'required'),
			array('Proveedor','unique','on'=>'create'),
			array('Proveedor', 'uniqueDescripcion','on'=>'update'),
			array('Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			array('Proveedor', 'length', 'max'=>300),
			array('Tel', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Proveedor, Proveedor, Tel, Observaciones, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, usuario_creacion, usuario_actualizacion, orderby', 'safe', 'on'=>'search'),
		);
	}

	public function uniqueDescripcion($attribute,$params){
        
  		//se busca el mismo nombre de usuario con id diferente al registro afectado
        $criteria=new CDbCriteria;
		$criteria->condition='Proveedor=:Proveedor AND Id_Proveedor!=:Id_Proveedor';
		$criteria->params=array(':Proveedor'=>$this->Proveedor,':Id_Proveedor'=>$this->Id_Proveedor);
		$modelopro=Proveedor::model()->find($criteria);

        if(!is_null($modelopro)){
        	$this->addError($attribute, 'Este proveedor ya esta registrado.');
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
			'idusuariocre' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Creacion'),
			'idusuarioact' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Actualizacion'),
			'tHEQUIPOs' => array(self::HAS_MANY, 'THEQUIPO', 'Proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_Proveedor' => 'ID',
			'Proveedor' => 'Proveedor',
			'Tel' => 'Teléfono',
			'Observaciones' => 'Observaciones',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'Estado' => 'Estado',
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
	   	$criteria->with=array('idusuariocre','idusuarioact');

		
		$criteria->compare('t.Id_Proveedor',$this->Id_Proveedor);
		$criteria->compare('t.Proveedor',$this->Proveedor,true);
		$criteria->compare('t.Estado',$this->Estado);
		
		if($this->Fecha_Creacion != ""){
      		$fci = $this->Fecha_Creacion." 00:00:00";
      		$fcf = $this->Fecha_Creacion." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Creacion', $fci, $fcf);
    	}

    	if($this->Fecha_Actualizacion != ""){
      		$fai = $this->Fecha_Actualizacion." 00:00:00";
      		$faf = $this->Fecha_Actualizacion." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Actualizacion', $fai, $faf);
    	}

		if($this->usuario_creacion != ""){
			$criteria->AddCondition("idusuariocre.Usuario = '".$this->usuario_creacion."'"); 
	    }

    	if($this->usuario_actualizacion != ""){
			$criteria->AddCondition("idusuarioact.Usuario = '".$this->usuario_actualizacion."'"); 
	    }

	    if(empty($this->orderby)){
			$criteria->order = 't.Id_Proveedor DESC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Proveedor ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Proveedor DESC'; 
			        break;
			    case 3:
			        $criteria->order = 't.Proveedor ASC'; 
			        break;
			    case 4:
			        $criteria->order = 't.Proveedor DESC'; 
			        break;
		        case 5:
			        $criteria->order = 'idusuariocre.Usuario ASC'; 
			        break;
			    case 6:
			        $criteria->order = 'idusuariocre.Usuario DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Fecha_Creacion ASC'; 
			        break;
			    case 8:
			        $criteria->order = 't.Fecha_Creacion DESC'; 
			        break;
			    case 9:
			        $criteria->order = 'idusuarioact.Usuario ASC'; 
			        break;
			    case 10:
			        $criteria->order = 'idusuarioact.Usuario DESC'; 
			        break;
				case 11:
			        $criteria->order = 't.Fecha_Actualizacion ASC'; 
			        break;
			    case 12:
			        $criteria->order = 't.Fecha_Actualizacion DESC'; 
			        break;
			    case 13:
			        $criteria->order = 't.Estado DESC'; 
			        break;
			    case 14:
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
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proveedor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
