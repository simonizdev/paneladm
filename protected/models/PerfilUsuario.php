<?php

/**
 * This is the model class for table "TH_PERFIL_USUARIO".
 *
 * The followings are the available columns in table 'TH_PERFIL_USUARIO':
 * @property integer $Id_P_Usuario
 * @property integer $Id_Usuario
 * @property integer $Id_Usuario_Creacion
 * @property integer $Id_Usuario_Actualizacion
 * @property integer $Id_Perfil
 * @property boolean $Estado
 * @property string $Fecha_Creacion
 * @property string $Fecha_Actualizacion
 *
 * The followings are the available model relations:
 * @property THPERFIL $idPerfil
 * @property THUSUARIO $idUsuario
 * @property THUSUARIO $idUsuarioCreacion
 * @property THUSUARIO $idUsuarioActualizacion
 */
class PerfilUsuario extends CActiveRecord
{
	
	public $usuario;
	public $perfil;
	public $usuario_creacion;
	public $usuario_actualizacion;
	public $orderby;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TH_PERFIL_USUARIO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_Usuario, Id_Perfil', 'required'),
			array('Id_Usuario, Id_Usuario_Creacion, Id_Usuario_Actualizacion, Id_Perfil', 'numerical', 'integerOnly'=>true),
			array('Fecha_Creacion, Fecha_Actualizacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_P_Usuario, Id_Usuario, Id_Usuario_Creacion, Id_Usuario_Actualizacion, Id_Perfil, Estado, Fecha_Creacion, Fecha_Actualizacion, usuario, usuario_creacion, usuario_actualizacion, perfil, orderby', 'safe', 'on'=>'search'),
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
			'idusuarioact' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Actualizacion'),
			'idusuariocre' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario_Creacion'),
			'idperfil' => array(self::BELONGS_TO, 'Perfil', 'Id_Perfil'),
			'idusuario' => array(self::BELONGS_TO, 'Usuario', 'Id_Usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_P_Usuario' => 'Id P Usuario',
			'Id_Usuario' => 'Id Usuario',
			'Id_Usuario_Creacion' => 'Id Usuario Creacion',
			'Id_Usuario_Actualizacion' => 'Id Usuario Actualizacion',
			'Id_Perfil' => 'Id Perfil',
			'Estado' => 'Estado',
			'Fecha_Creacion' => 'Fecha Creacion',
			'Fecha_Actualizacion' => 'Fecha Actualizacion',

			'Id_P_Usuario' => 'ID',
			'Id_Usuario' => 'Usuario',
			'Id_Usuario_Creacion' => 'Usuario que creo',
			'Id_Usuario_Actualizacion' => 'Usuario que actualizó',
			'Id_Perfil' => 'Perfil',
			'Estado' => 'Estado',
			'Fecha_Creacion' => 'Fecha de creación',
			'Fecha_Actualizacion' => 'Fecha de actualización',
			'usuario' => 'Usuario',
			'perfil' => 'Perfil',
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
	   	$criteria->with=array('idusuario', 'idperfil','idusuariocre','idusuarioact');

		$criteria->compare('t.Id_P_Usuario',$this->Id_P_Usuario);
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

	    if($this->usuario != ""){
			$criteria->AddCondition("idusuario.Usuario = '".$this->usuario."'"); 
	    }


	    if($this->perfil != ""){
			$criteria->AddCondition("idperfil.Descripcion = '".$this->perfil."'"); 
	    }

	    if(empty($this->orderby)){
			$criteria->order = 't.Id_P_Usuario DESC'; 	
		}else{
			switch ($this->orderby) {
			    case 1:
			        $criteria->order = 't.Id_P_Usuario ASC'; 
			        break;
			    case 2:
			        $criteria->order = 't.Id_P_Usuario DESC'; 
			        break;
			    case 3:
			        $criteria->order = 'idusuario.Usuario ASC'; 
			        break;
			    case 4:
			        $criteria->order = 'idusuario.Usuario DESC'; 
			        break;
			    case 5:
			        $criteria->order = 'idperfil.Descripcion ASC'; 
			        break;
			    case 6:
			        $criteria->order = 'idperfil.Descripcion DESC'; 
			        break;
		        case 7:
			        $criteria->order = 'idusuariocre.Usuario ASC'; 
			        break;
			    case 8:
			        $criteria->order = 'idusuariocre.Usuario DESC'; 
			        break;
			    case 9:
			        $criteria->order = 't.Fecha_Creacion ASC'; 
			        break;
			    case 10:
			        $criteria->order = 't.Fecha_Creacion DESC'; 
			        break;
			    case 11:
			        $criteria->order = 'idusuarioact.Usuario ASC'; 
			        break;
			    case 12:
			        $criteria->order = 'idusuarioact.Usuario DESC'; 
			        break;
				case 13:
			        $criteria->order = 't.Fecha_Actualizacion ASC'; 
			        break;
			    case 14:
			        $criteria->order = 't.Fecha_Actualizacion DESC'; 
			        break;
			    case 15:
			        $criteria->order = 't.Estado DESC'; 
			        break;
			    case 16:
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
	 * @return PerfilUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
