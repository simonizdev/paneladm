<?php
/* @var $this EquipoAntivirusController */
/* @var $model EquipoAntivirus */

//para combos de tipos de licencia
$tipos_lic = CHtml::listData($tipos_licencia, 'Id_Dominio', 'Dominio');

//para combos de versiones de auntivirus
$vers_ant = CHtml::listData($versiones_antivirus, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

?>

<h3>Asociando licencia de antivirus a equipo</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'e' => $e, 'tipos_licencia' => $tipos_lic, 'versiones_antivirus' => $vers_ant, 'lista_empresas'=>$lista_empresas, 'lista_proveedores'=>$lista_proveedores)); ?>