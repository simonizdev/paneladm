<?php
/* @var $this EquipoController */
/* @var $model Equipo */

//para combos de tipos de equipo
$lista_tipos = CHtml::listData($tipos, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

?>

<h3>Creación de equipo</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'lista_tipos'=>$lista_tipos, 'lista_empresas'=>$lista_empresas, 'lista_proveedores'=>$lista_proveedores)); ?>