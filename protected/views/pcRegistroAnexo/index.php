<?php
/* @var $this PcRegistroAnexoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Registro Anexos',
);

$this->menu=array(
	array('label'=>'Create PcRegistroAnexo', 'url'=>array('create')),
	array('label'=>'Manage PcRegistroAnexo', 'url'=>array('admin')),
);
?>

<h1>Pc Registro Anexos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
