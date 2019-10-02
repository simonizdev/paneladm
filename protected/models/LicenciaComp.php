<?php

/**
 * This is the model class for table "TH_LICENCIA_COMP".
 *
 * The followings are the available columns in table 'TH_LICENCIA_COMP':
 * @property integer $Id_Licencia_Comp
 * @property string $Software
 * @property string $Serial
 * @property integer $Cant_Usuarios
 * @property string $Notas
 * @property string $Fecha_Inicio_Sop
 * @property string $Fecha_Final_Sop
 * @property integer $Proveedor
 * @property integer $Empresa_Compra
 * @property string $Factura_Compra
 * @property string $Fecha_Compra
 * @property integer $Valor_Comercial
 * @property string $Numero_Inventario
 * @property string $Doc_Soporte
 * @property integer $Estado
 * @property integer $Id_Usuario_Creacion
 * @property string $Fecha_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property string $Fecha_Actualizacion
 *
 * The followings are the available model relations:
 * @property THPROVEEDOR $proveedor
 * @property THEMPRESA $empresaCompra
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class LicenciaComp extends CActiveRecord
{
	
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;
	public $sop;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_LICENCIA_COMP';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Software, Serial, Cant_Usuarios, Notas, Fecha_Inicio_Sop, Fecha_Final_Sop, Proveedor, Empresa_Compra, Factura_Compra, Fecha_Compra, Valor_Comercial, Numero_Inventario, Estado', 'required'),
			array('Cant_Usuarios, Proveedor, Empresa_Compra, Valor_Comercial, Estado, Id_Usuario_Creacion, Id_Usuario_Actualizacion', 'numerical', 'integerOnly'=>true),
			array('Software, Serial, Doc_Soporte', 'length', 'max'=>200),
			array('Factura_Compra, Numero_Inventario', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Licencia_Comp, Software, Serial, Cant_Usuarios, Notas, Fecha_Inicio_Sop, Fecha_Final_Sop, Proveedor, Empresa_Compra, Factura_Compra, Fecha_Compra, Valor_Comercial, Numero_Inventario, Doc_Soporte, Estado, Id_Usuario_Creacion, Fecha_Creacion, Id_Usuario_Actualizacion, Fecha_Actualizacion', 'safe', 'on'=>'search'),
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
			'Id_Licencia_Comp' => 'ID',
			'Software' => 'Software',
			'Serial' => 'Serial',
			'Cant_Usuarios' => 'N° de usuarios',
			'Notas' => 'Notas',
			'Fecha_Inicio_Sop' => 'Fecha inicial de soporte',
			'Fecha_Final_Sop' => 'Fecha final de soporte',
			'Proveedor' => 'Proveedor',
			'Empresa_Compra' => 'Empresa que compro',
			'Factura_Compra' => ' N° de factura de compra',
			'Fecha_Compra' => 'Fecha de compra',
			'Valor_Comercial' => 'Valor comercial',
			'Numero_Inventario' => 'N° de inventario',
			'Doc_Soporte' => 'Soporte',
			'Estado' => 'Estado',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Fecha_Creacion' => 'Fecha de creación',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario_creacion' => 'Usuario que creo',
			'usuario_actualizacion' => 'Usuario que actualizó',
			'orderby' => 'Orden de resultados',
			'sop' => 'Soporte',
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
		$criteria->with=array('proveedor', 'empresacompra');

		if($this->Id_Licencia_Comp != ""){
			$criteria->AddCondition("t.Id_Licencia_Comp = '".$this->Id_Licencia_Comp."'"); 
	    }

	    $criteria->compare('t.Software',$this->Software,true);
	    $criteria->compare('t.Serial',$this->Serial,true);
	    $criteria->compare('t.Cant_Usuarios',$this->Cant_Usuarios,true);

	    if($this->Empresa_Compra != ""){
			$criteria->AddCondition("t.Empresa_Compra = '".$this->Empresa_Compra."'"); 
	    }

    	if($this->Proveedor != ""){
			$criteria->AddCondition("t.Proveedor = '".$this->Proveedor."'"); 
	    }

	    $criteria->compare('t.Estado',$this->Estado);

	    if(empty($this->orderby)){
			$criteria->order = 't.Id_Licencia_Comp DESC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_Licencia_Comp ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_Licencia_Comp DESC'; 
			        break;
			    case 3:
			        $criteria->order = 't.Software ASC'; 
			        break;
			    case 4:
			        $criteria->order = 't.Software DESC'; 
			        break;
			    case 5:
			        $criteria->order = 't.Serial ASC'; 
			        break;
			    case 6:
			        $criteria->order = 't.Serial DESC'; 
			        break;
			    case 7:
			        $criteria->order = 't.Cant_Usuarios DESC'; 
			        break;
			    case 8:
			        $criteria->order = 't.Cant_Usuarios ASC'; 
			        break;
			    case 9:
			        $criteria->order = 'empresacompra.Descripcion DESC'; 
			        break;
			    case 10:
			        $criteria->order = 'empresacompra.Descripcion ASC'; 
			        break;
			    case 11:
			        $criteria->order = 'proveedor.Proveedor ASC'; 
			        break;
			    case 12:
			        $criteria->order = 'proveedor.Proveedor DESC'; 
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
	 * @return LicenciaComp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
