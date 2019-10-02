<?php
/* @var $this PcRegistroController */
/* @var $model PcRegistro */

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

?>

<h3>Actualización de registro</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'lista_empresas' => $lista_empresas)); ?>