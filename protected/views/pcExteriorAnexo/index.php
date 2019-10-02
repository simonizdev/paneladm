<?php
/* @var $this PcExteriorAnexoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Exterior Anexos',
);

$this->menu=array(
	array('label'=>'Create PcExteriorAnexo', 'url'=>array('create')),
	array('label'=>'Manage PcExteriorAnexo', 'url'=>array('admin')),
);
?>

<h1>Pc Exterior Anexos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
