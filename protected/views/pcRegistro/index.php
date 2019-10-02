<?php
/* @var $this PcRegistroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Registros',
);

$this->menu=array(
	array('label'=>'Create PcRegistro', 'url'=>array('create')),
	array('label'=>'Manage PcRegistro', 'url'=>array('admin')),
);
?>

<h1>Pc Registros</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
