<?php

/**
 * This is the model class for table "TH_EQUIPO_OL".
 *
 * The followings are the available columns in table 'TH_EQUIPO_OL':
 * @property integer $Id_Equipo_Ol
 * @property integer $Id_Equipo
 * @property integer $Tipo_Licencia
 * @property integer $Producto
 * @property string $Num_Licencia
 * @property string $Notas
 * @property string $Fecha_Inicio
 * @property string $Fecha_Final
 * @property integer $Proveedor
 * @property integer $Empresa_Compra
 * @property string $Numero_Factura
 * @property string $Fecha_Factura
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
 * @property THDOMINIO $producto
 * @property THPROVEEDOR $proveedor
 * @property THEMPRESA $empresaCompra
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class EquipoOl extends CActiveRecord
{
	
	public $sop;
	public $sop2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_EQUIPO_OL';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Equipo, Tipo_Licencia, Producto, Num_Licencia, Proveedor, Empresa_Compra, Numero_Factura, Fecha_Factura, Doc_Soporte, Estado', 'required'),
			array('Id_Equipo, Tipo_Licencia, Producto, Proveedor, Empresa_Compra, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			array('Num_Licencia, Doc_Soporte', 'length', 'max'=>200),
			array('Numero_Factura', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Equipo_Ol, Id_Equipo, Tipo_Licencia, Producto, Num_Licencia, Notas, Fecha_Inicio, Fecha_Final, Proveedor, Empresa_Compra, Numero_Factura, Fecha_Factura, Doc_Soporte, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion', 'safe', 'on'=>'search'),
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
			'idequipo' => array(self::BELONGS_TO, 'Equipo', 'Id_Equipo'),
			'tipolicencia' => array(self::BELONGS_TO, 'Dominio', 'Tipo_Licencia'),
			'producto' => array(self::BELONGS_TO, 'Dominio', 'Producto'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'Proveedor'),
			'empresacompra' => array(self::BELONGS_TO, 'Empresa', 'Empresa_Compra'),
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
			'Id_Equipo_Ol' => 'ID',
			'Id_Equipo' => 'Equipo (Tipo / Serial)',
			'Tipo_Licencia' => 'Tipo de licencia',
			'Producto' => 'Producto',
			'Num_Licencia' => 'N° de licencia',
			'Notas' => 'Notas',
			'Fecha_Inicio' => 'Fecha de inicio',
			'Fecha_Final' => 'Fecha de Finalización',
			'Proveedor' => 'Proveedor',
			'Empresa_Compra' => 'Empresa que compro',
			'Numero_Factura' => 'N° de factura',
			'Fecha_Factura' => 'Fecha de factura',
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

		$criteria->compare('Id_Equipo_Ol',$this->Id_Equipo_Ol);
		$criteria->compare('Id_Equipo',$this->Id_Equipo);
		$criteria->compare('Tipo_Licencia',$this->Tipo_Licencia);
		$criteria->compare('Producto',$this->Producto);
		$criteria->compare('Num_Licencia',$this->Num_Licencia,true);
		$criteria->compare('Notas',$this->Notas,true);
		$criteria->compare('Fecha_Inicio',$this->Fecha_Inicio,true);
		$criteria->compare('Fecha_Final',$this->Fecha_Final,true);
		$criteria->compare('Proveedor',$this->Proveedor);
		$criteria->compare('Empresa_Compra',$this->Empresa_Compra);
		$criteria->compare('Numero_Factura',$this->Numero_Factura,true);
		$criteria->compare('Fecha_Factura',$this->Fecha_Factura,true);
		$criteria->compare('Doc_Soporte',$this->Doc_Soporte,true);
		$criteria->compare('Estado',$this->Estado);
		$criteria->compare('Id_Usuario_Creacion',$this->Id_Usuario_Creacion);
		$criteria->compare('Fecha_Creacion',$this->Fecha_Creacion,true);
		$criteria->compare('Id_Usuario_Actualizacion',$this->Id_Usuario_Actualizacion);
		$criteria->compare('Fecha_Actualizacion',$this->Fecha_Actualizacion,true);
		$criteria->compare('Doc_Soporte2',$this->Doc_Soporte2,true);
		$criteria->order = 't.Id_Equipo_Ol DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EquipoOl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
