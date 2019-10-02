<?php
/* @var $this PcProcJurController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Proc Jurs',
);

$this->menu=array(
	array('label'=>'Create PcProcJur', 'url'=>array('create')),
	array('label'=>'Manage PcProcJur', 'url'=>array('admin')),
);
?>

<h1>Pc Proc Jurs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
