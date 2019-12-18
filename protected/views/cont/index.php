<?php
/* @var $this ContController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Conts',
);

$this->menu=array(
	array('label'=>'Create Cont', 'url'=>array('create')),
	array('label'=>'Manage Cont', 'url'=>array('admin')),
);
?>

<h1>Conts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
