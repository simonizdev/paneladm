<?php

/**
 * This is the model class for table "TH_PC_CONTRATO".
 *
 * The followings are the available columns in table 'TH_PC_CONTRATO':
 * @property integer $Id_Pc_Contrato
 * @property integer $Empresa
 * @property string $Proveedor
 * @property string $Concepto_Contrato
 * @property string $Fecha_Inicial
 * @property string $Fecha_Final
 * @property string $Fecha_Ren_Can
 * @property integer $Vlr_Contrato
 * @property string $Area
 * @property string $Observaciones
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 * @property integer $Periodicidad
 * @property integer $Dias_Alerta
 *
 * The followings are the available model relations:
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class PcContrato extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;
	public $doc;
	public $num_doc;
	public $view;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PC_CONTRATO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Empresa, Proveedor, Concepto_Contrato, Fecha_Inicial, Fecha_Final, Fecha_Ren_Can, Vlr_Contrato, Area, Observaciones, Estado, Periodicidad, Dias_Alerta', 'required'),
			array('Empresa, Vlr_Contrato, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion, Periodicidad, Dias_Alerta', 'numerical', 'integerOnly'=>true),
			array('Proveedor, Area', 'length', 'max'=>100),
			array('Concepto_Contrato', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Pc_Contrato, Empresa, Proveedor, Concepto_Contrato, Fecha_Inicial, Fecha_Final, Fecha_Ren_Can, Vlr_Contrato, Area, Observaciones, Periodicidad, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, usuario_creacion, usuario_actualizacion, orderby, view', 'safe', 'on'=>'search'),
		);
	}

	public function Num_Doc($id_contrato){

		$modelo_doc = PcDocContrato::model()->findAllByAttributes(array('Id_Contrato'=> $id_contrato, 'Estado' => 1));

		if(!empty($modelo_doc)){	
			$num_doc = count($modelo_doc);
        	return $num_doc;
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
			'Id_Pc_Contrato' => 'ID',
			'Empresa' => 'Empresa',
			'Proveedor' => 'Proveedor',
			'Concepto_Contrato' => 'Concepto',
			'Fecha_Inicial' => 'Fecha inicial',
			'Fecha_Final' => 'Fecha final',
			'Fecha_Ren_Can' => 'Fecha renovación / cancelación',
			'Vlr_Contrato' => 'Valor',
			'Area' => 'Área',
			'Observaciones' => 'Observaciones',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario_creacion' => 'Usuario que creo',
			'usuario_actualizacion' => 'Usuario que actualizó',
			'orderby' => 'Orden de resultados',
			'doc' => 'Documento',
			'num_doc' => 'Doc. asociados',
			'Periodicidad' => 'Periodicidad de pago',
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

		$criteria->compare('t.Id_Pc_Contrato',$this->Id_Pc_Contrato);

		if($this->Empresa != ""){
			$criteria->AddCondition("t.Empresa = '".$this->Empresa."'"); 
	    }

		$criteria->compare('t.Proveedor',$this->Proveedor,true);
		$criteria->compare('t.Concepto_Contrato',$this->Concepto_Contrato,true);

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

    	if($this->Fecha_Ren_Can != ""){
      		$fai = $this->Fecha_Ren_Can." 00:00:00";
      		$faf = $this->Fecha_Ren_Can." 23:59:59";

      		$criteria->addBetweenCondition('t.Fecha_Ren_Can', $fai, $faf);
    	}

	    if(!empty($this->view)){
			switch ($this->view) {
			    case 1:
			        $criteria->AddCondition("DATEDIFF(day,'".date('Y-m-d')."',t.Fecha_Ren_Can) < t.Dias_Alerta AND t.Estado = 1");
			        break;
			    case 2:
			        $criteria->AddCondition("DATEDIFF(day,'".date('Y-m-d')."',t.Fecha_Ren_Can) >= t.Dias_Alerta AND t.Estado = 1"); 
			        break;
			    case 3:
			        $criteria->AddCondition("t.Estado = 0");
			        break;
			}			
		}

	    if(empty($this->orderby)){
			$criteria->order = 't.Proveedor ASC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Pc_Contrato ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Pc_Contrato DESC'; 
			        break;
			    case 3:
			        $criteria->order = 'empresa.Descripcion ASC'; 
			        break;
			    case 4:
			        $criteria->order = 'empresa.Descripcion DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Proveedor ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Proveedor DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Concepto_Contrato ASC'; 
			        break;
			    case 8:
			        $criteria->order = 't.Concepto_Contrato DESC'; 
			        break;
			    case 9:
			        $criteria->order = 'periodicidad.Dominio ASC'; 
			        break;
			    case 10:
			        $criteria->order = 'periodicidad.Dominio DESC'; 
			        break;
			    case 11:
			        $criteria->order = 't.Area ASC'; 
			        break;
			    case 12:
			        $criteria->order = 't.Area DESC'; 
			        break;
			    case 13:
			        $criteria->order = 't.Fecha_Inicial ASC'; 
			        break;
			    case 14:
			        $criteria->order = 't.Fecha_Inicial DESC'; 
			        break; 
			    case 15:
			        $criteria->order = 't.Fecha_Final DESC'; 
			        break;
			    case 16:
			        $criteria->order = 't.Fecha_Final ASC'; 
			        break;
			    case 17:
			        $criteria->order = 't.Fecha_Ren_Can DESC'; 
			        break;
			    case 18:
			        $criteria->order = 't.Fecha_Ren_Can ASC'; 
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
	 * @return PcContrato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
