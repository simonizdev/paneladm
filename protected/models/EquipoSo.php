<?php

/**
 * This is the model class for table "TH_EQUIPO_SO".
 *
 * The followings are the available columns in table 'TH_EQUIPO_SO':
 * @property integer $Id_Equipo_So
 * @property integer $Id_Equipo
 * @property integer $Tipo_Licencia
 * @property integer $Version
 * @property string $Num_Licencia
 * @property string $Doc_Soporte
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 * @property string $Doc_Soporte2
 *
 * The followings are the available model relations:
 * @property THEQUIPO $idEquipo
 * @property THDOMINIO $tipoLicencia
 * @property THDOMINIO $version
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class EquipoSo extends CActiveRecord
{
	
	public $sop;
	public $sop2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_EQUIPO_SO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Equipo, Tipo_Licencia, Version, Num_Licencia, Doc_Soporte, Estado', 'required'),
			array('Id_Equipo, Tipo_Licencia, Version, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			array('Num_Licencia, Doc_Soporte', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Equipo_So, Id_Equipo, Tipo_Licencia, Version, Num_Licencia, Doc_Soporte, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion', 'safe', 'on'=>'search'),
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
			'equipo' => array(self::BELONGS_TO, 'Equipo', 'Id_Equipo'),
			'tipolicencia' => array(self::BELONGS_TO, 'Dominio', 'Tipo_Licencia'),
			'version' => array(self::BELONGS_TO, 'Dominio', 'Version'),
			'idusuariocre' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Creacion'),
			'idusuarioact' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Actualizacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_Equipo_So' => 'ID',
			'Id_Equipo' => 'Equipo (Tipo / Serial)',
			'Tipo_Licencia' => 'Tipo de licencia',
			'Version' => 'Versión',
			'Num_Licencia' => 'N° de licencia',
			'Doc_Soporte' => 'Soporte',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Fecha_Creacion' => 'Fecha de creación',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'Doc_Soporte2' => 'Soporte 2',
			'sop' => 'Soporte',
			'sop2' => 'Soporte 2',
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

		$criteria->compare('Id_Equipo_So',$this->Id_Equipo_So);
		$criteria->compare('Id_Equipo',$this->Id_Equipo);
		$criteria->compare('Tipo_Licencia',$this->Tipo_Licencia);
		$criteria->compare('Version',$this->Version);
		$criteria->compare('Num_Licencia',$this->Num_Licencia,true);
		$criteria->compare('Doc_Soporte',$this->Doc_Soporte,true);
		$criteria->compare('Estado',$this->Estado);
		$criteria->compare('Id_Usuario_Creacion',$this->Id_Usuario_Creacion);
		$criteria->compare('Fecha_Creacion',$this->Fecha_Creacion,true);
		$criteria->compare('Id_Usuario_Actualizacion',$this->Id_Usuario_Actualizacion);
		$criteria->compare('Fecha_Actualizacion',$this->Fecha_Actualizacion,true);
		$criteria->compare('Doc_Soporte2',$this->Doc_Soporte2,true);
		$criteria->order = 't.Id_Equipo_So DESC'; 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EquipoSo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
