<?php
/* @var $this PcExteriorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Exteriors',
);

$this->menu=array(
	array('label'=>'Create PcExterior', 'url'=>array('create')),
	array('label'=>'Manage PcExterior', 'url'=>array('admin')),
);
?>

<h1>Pc Exteriors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
