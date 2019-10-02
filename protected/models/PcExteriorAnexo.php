<?php

/**
 * This is the model class for table "TH_PC_EXTERIOR_ANEXO".
 *
 * The followings are the available columns in table 'TH_PC_EXTERIOR_ANEXO':
 * @property integer $Id_Anexo_Pc_Ext
 * @property integer $Id_Pc_Ext
 * @property string $Titulo
 * @property string $Doc_Soporte
 * @property string $Descripcion
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 *
 * The followings are the available model relations:
 * @property THPCEXTERIOR $idPcExt
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class PcExteriorAnexo extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;
	public $doc;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PC_EXTERIOR_ANEXO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Pc_Ext, Titulo, Descripcion, Estado', 'required'),
			array('Id_Pc_Ext, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			array('Titulo, Doc_Soporte', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Anexo_Pc_Ext, Id_Pc_Ext, Titulo, Doc_Soporte, Descripcion, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion, usuario_creacion, usuario_actualizacion, orderby', 'safe', 'on'=>'search'),
		);
	}

	public function Desc_Pc_Ext($id_pc_ext){

		$modelo_pc_exterior = PcExterior::model()->findByPk($id_pc_ext);
		return $modelo_pc_exterior->Id_Pc_Ext.' / '.$modelo_pc_exterior->Descripcion;

    }

    public function searchByPcExt($filtro) {
        
        $resp = Yii::app()->db->createCommand("
		    SELECT TOP 10 Id_Pc_Ext, CONCAT (Id_Pc_Ext, ' / ', Descripcion) AS Descr FROM TH_PC_EXTERIOR WHERE (Descripcion LIKE '%".$filtro."%') ORDER BY DESCR 
		")->queryAll();
        return $resp;
        
 	}

 	public function searchById($filtro) {
 
        $resp = Yii::app()->db->createCommand("
		    SELECT Id_Pc_Ext, CONCAT (Id_Pc_Ext, ' / ', Descripcion) AS Descr FROM TH_PC_EXTERIOR WHERE Id_Pc_Ext = ".$filtro)->queryAll();
        return $resp;

 	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idpcext' => array(self::BELONGS_TO, 'PcExterior', 'Id_Pc_Ext'),
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
			'Id_Anexo_Pc_Ext' => 'ID',
			'Id_Pc_Ext' => 'Control (ID / Descripción)',
			'Doc_Soporte' => 'Documento',
			'Titulo' => 'Nombre',
			'Descripcion' => 'Descripción',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario_creacion' => 'Usuario que creo',
			'usuario_actualizacion' => 'Usuario que actualizó',
			'orderby' => 'Orden de resultados',
			'doc' => 'Documento',
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
		$criteria->with=array('idpcext');

		if($this->Id_Anexo_Pc_Ext != ""){
			$criteria->AddCondition("t.Id_Anexo_Pc_Ext = '".$this->Id_Anexo_Pc_Ext."'"); 
	    }

	    if($this->Id_Pc_Ext != ""){
			$criteria->AddCondition("t.Id_Pc_Ext = '".$this->Id_Pc_Ext."'"); 
	    }

	    $criteria->compare('t.Titulo',$this->Titulo);
	    $criteria->compare('t.Estado',$this->Estado);

	    if(empty($this->orderby)){
			$criteria->order = 't.Id_Anexo_Pc_Ext DESC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Anexo_Pc_Ext ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Anexo_Pc_Ext DESC'; 
			        break;
			    case 3:
			        $criteria->order = 'idpcext.Descripcion ASC'; 
			        break;
			    case 4:
			        $criteria->order = 'idpcext.Descripcion DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Titulo ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Titulo DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Estado DESC'; 
			        break;
			    case 8:
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
	 * @return PcExteriorAnexo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
