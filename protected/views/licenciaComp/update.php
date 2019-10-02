<?php
/* @var $this LicenciaCompController */
/* @var $model LicenciaComp */

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

?>

<h3>Actualización de licencia compartida</h3>

<?php $this->renderPartial('_form2', array('model'=>$model, 'lista_empresas'=>$lista_empresas, 'lista_proveedores'=>$lista_proveedores)); ?>