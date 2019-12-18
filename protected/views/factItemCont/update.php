<?php
/* @var $this FactItemContController */
/* @var $model FactItemCont */

//para combos de items 
$lista_items = CHtml::listData($items, 'Id_Item', 'Item');

?>

<h3>Actualizando factura de contrato</h3>

<?php $this->renderPartial('_form2', array('model'=>$model, 'c'=>$c, 'lista_items'=>$lista_items)); ?>