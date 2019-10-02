<?php
/* @var $this PcDocContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Doc Contratos',
);

$this->menu=array(
	array('label'=>'Create PcDocContrato', 'url'=>array('create')),
	array('label'=>'Manage PcDocContrato', 'url'=>array('admin')),
);
?>

<h1>Pc Doc Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
