<?php
/* @var $this PcNacionalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Nacionals',
);

$this->menu=array(
	array('label'=>'Create PcNacional', 'url'=>array('create')),
	array('label'=>'Manage PcNacional', 'url'=>array('admin')),
);
?>

<h1>Pc Nacionals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
