<?php
/* @var $this EquipoOfficeController */
/* @var $model EquipoOffice */

//para combos de tipos de licencia
$tipos_lic = CHtml::listData($tipos_licencia, 'Id_Dominio', 'Dominio');

//para combos de versiones de office
$vers_off = CHtml::listData($versiones_office, 'Id_Dominio', 'Dominio');

//para combos de productos de office
$pro_off = CHtml::listData($productos_office, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

?>

<h3>Asociando licencia de office a equipo</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'e' => $e, 'tipos_licencia' => $tipos_lic, 'versiones_office' => $vers_off, 'productos_office' => $pro_off, 'lista_empresas'=>$lista_empresas, 'lista_proveedores'=>$lista_proveedores)); ?>