<?php
/* @var $this NegContController */
/* @var $model NegCont */

//para combos de monedas
$lista_monedas = CHtml::listData($monedas, 'Id_Dominio', 'Dominio');

?>

<h3>Actualizando negociación de contrato</h3>

<?php $this->renderPartial('_form2', array('model'=>$model, 'c'=>$c, 'lista_monedas'=>$lista_monedas)); ?>