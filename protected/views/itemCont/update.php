<?php
/* @var $this ItemContController */
/* @var $model ItemCont */

//para combos de monedas
$lista_monedas = CHtml::listData($monedas, 'Id_Dominio', 'Dominio');

?>

<h3>Actualizando item de contrato</h3>

<?php $this->renderPartial('_form2', array('model'=>$model, 'c'=>$c, 'lista_monedas'=>$lista_monedas)); ?>