<?php
/* @var $this FactItemContController */
/* @var $model FactItemCont */

//para combos de items 
$lista_items = CHtml::listData($items, 'Id_Item', 'IdItem_Item');

?>

<h3>Asociando factura a contrato</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'c'=>$c, 'lista_items'=>$lista_items)); ?>