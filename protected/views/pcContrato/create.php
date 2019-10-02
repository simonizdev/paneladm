<?php
/* @var $this PcContratoController */
/* @var $model PcContrato */

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

//para combos de tipos de periodicidad
$lista_period = CHtml::listData($period, 'Id_Dominio', 'Dominio');

?>

<h3>Creación de contrato</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'lista_empresas' => $lista_empresas, 'lista_period' => $lista_period)); ?>