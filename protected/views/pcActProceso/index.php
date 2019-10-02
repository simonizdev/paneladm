<?php
/* @var $this PcActProcesoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Act Procesos',
);

$this->menu=array(
	array('label'=>'Create PcActProceso', 'url'=>array('create')),
	array('label'=>'Manage PcActProceso', 'url'=>array('admin')),
);
?>

<h1>Pc Act Procesos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
