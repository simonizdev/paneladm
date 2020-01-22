<?php
/* @var $this NegContController */
/* @var $model NegCont */

//para combos de monedas
$lista_monedas = CHtml::listData($monedas, 'Id_Dominio', 'Dominio');

?>

<h3>Asociando negociación a contrato</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'c'=>$c, 'lista_monedas'=>$lista_monedas)); ?>