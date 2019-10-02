<?php
/* @var $this EquipoOlController */
/* @var $model EquipoOl */

//para combos de tipos de licencia
$tipos_lic = CHtml::listData($tipos_licencia, 'Id_Dominio', 'Dominio');

//para combos de otros productos licencias
$otros_p_l = CHtml::listData($otros_productos, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

?>

<h3>Asociando producto / licencia a equipo</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'e' => $e, 'tipos_licencia' => $tipos_lic, 'otros_productos' => $otros_p_l, 'lista_empresas'=>$lista_empresas, 'lista_proveedores'=>$lista_proveedores)); ?>