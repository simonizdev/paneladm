<?php
/* @var $this FactItemContController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fact Item Conts',
);

$this->menu=array(
	array('label'=>'Create FactItemCont', 'url'=>array('create')),
	array('label'=>'Manage FactItemCont', 'url'=>array('admin')),
);
?>

<h1>Fact Item Conts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
