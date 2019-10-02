<?php
/* @var $this PcContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Contratos',
);

$this->menu=array(
	array('label'=>'Create PcContrato', 'url'=>array('create')),
	array('label'=>'Manage PcContrato', 'url'=>array('admin')),
);
?>

<h1>Pc Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
