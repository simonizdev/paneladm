<?php

/**
 * This is the model class for table "TH_FACT_ITEM_CONT".
 *
 * The followings are the available columns in table 'TH_FACT_ITEM_CONT':
 * @property integer $Id_Fac
 * @property integer $Id_Contrato
 * @property string $Items
 * @property string $Numero_Factura
 * @property string $Fecha_Factura
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 *
 * The followings are the available model relations:
 * @property THCONT $idContrato
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class FactItemCont extends CActiveRecord
{
	
	public $vlr_total;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_FACT_ITEM_CONT';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Contrato, Items, Numero_Factura, Fecha_Factura, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion', 'required'),
			array('Id_Contrato, Numero_Factura', 'ECompositeUniqueValidator', 'attributesToAddError'=>'Numero_Factura','message'=>'Esta factura ya fue asociada a este contrato.'),
			array('Id_Contrato, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			array('Numero_Factura', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Fac, Id_Contrato, Items, Numero_Factura, Fecha_Factura, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion', 'safe', 'on'=>'search'),
		);
	}

	public function DescEstado($Estado) {

		switch ($Estado) {
		    case 0:
		        return "ANULADA";
		    case 1:
		        return "RECIBIDA";
		}

 	}

 	public function TotalItems($items) {

		$modelo_items_cont= Yii::app()->db->createCommand("SELECT Cant, Vlr_Unit, Moneda FROM TH_ITEM_CONT WHERE Id_Item IN (".$items.") ORDER BY Moneda")->queryAll();

		$array_total_x_moneda = array();

		foreach ($modelo_items_cont as $reg) {
			
			$Moneda =$reg['Moneda'];
			$array_total_x_moneda[$Moneda] = 0; 	
		}
		
		foreach ($modelo_items_cont as $reg) {

			$Cant =$reg['Cant'];
			$Vlr_Unit =$reg['Vlr_Unit'];
			$Vlr_Total = $Vlr_Unit * $Cant;
			$Moneda =$reg['Moneda'];

			$array_total_x_moneda[$Moneda] = $array_total_x_moneda[$Moneda] + $Vlr_Total; 
			
		}

		$cadena_total = "";

		foreach ($array_total_x_moneda as $id_moneda => $valor) {
			$desc_moneda = Dominio::model()->findByPk($id_moneda)->Dominio;
			$cadena_total .= $desc_moneda.": ".number_format($valor, 0)." / ";
		}

		$resp = substr ($cadena_total, 0, -2);

		return $resp;

 	}

 	public function Desccontrato($Id_Contrato) {

		$modelo_cont = Cont::model()->findByPk($Id_Contrato);

		$desc_contrato = $modelo_cont->Id_Contrato.' / '.$modelo_cont->Proveedor.' - '.$modelo_cont->Concepto_Contrato;
		
		return $desc_contrato;

 	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idcontrato' => array(self::BELONGS_TO, 'Cont', 'Id_Contrato'),
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
			'Id_Fac' => 'ID',
			'Id_Contrato' => 'Contrato (ID / Proveedor - Concepto)',
			'Items' => 'Item(s)',
			'Numero_Factura' => 'N° de factura',
			'Fecha_Factura' => 'Fecha de factura',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'vlr_total' => 'Vlr. total',
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

		$criteria->compare('t.Id_Fac',$this->Id_Fac);
		$criteria->compare('t.Id_Contrato',$this->Id_Contrato);
		$criteria->compare('t.Items',$this->Items,true);
		$criteria->compare('t.Numero_Factura',$this->Numero_Factura,true);
		$criteria->compare('t.Fecha_Factura',$this->Fecha_Factura,true);
		$criteria->compare('t.Estado',$this->Estado);
		$criteria->compare('t.Id_Usuario_Creacion',$this->Id_Usuario_Creacion);
		$criteria->compare('t.Fecha_Creacion',$this->Fecha_Creacion,true);
		$criteria->compare('t.Id_Usuario_Actualizacion',$this->Id_Usuario_Actualizacion);
		$criteria->compare('t.Fecha_Actualizacion',$this->Fecha_Actualizacion,true);
		$criteria->order = 't.Id_Fac DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FactItemCont the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
