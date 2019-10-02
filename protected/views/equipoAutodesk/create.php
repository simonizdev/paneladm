<?php
/* @var $this EquipoAutodeskController */
/* @var $model EquipoAutodesk */

//para combos de tipos de licencia
$tipos_lic = CHtml::listData($tipos_licencia, 'Id_Dominio', 'Dominio');

//para combos de versiones de autodesk
$vers_auto = CHtml::listData($versiones_autodesk, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

?>

<h3>Asociando licencia de autodesk a equipo</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'e' => $e, 'tipos_licencia' => $tipos_lic, 'versiones_autodesk' => $vers_auto, 'lista_empresas'=>$lista_empresas, 'lista_proveedores'=>$lista_proveedores)); ?>