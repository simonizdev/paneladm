<?php
/* @var $this EquipoSoController */
/* @var $model EquipoSo */

//para combos de tipos de licencia
$tipos_lic = CHtml::listData($tipos_licencia, 'Id_Dominio', 'Dominio');

//para combos de versiones de sistema operativo
$vers_so = CHtml::listData($versiones_so, 'Id_Dominio', 'Dominio');

?>

<h3>Actualizando licencia (sistema operativo) de equipo</h3>

<?php $this->renderPartial('_form2', array('model'=>$model, 'e' => $e, 'tipos_licencia' => $tipos_lic, 'versiones_so' => $vers_so)); ?>