<?php
/* @var $this NetworkController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Networks',
);

$this->menu=array(
	array('label'=>'Create Network', 'url'=>array('create')),
	array('label'=>'Manage Network', 'url'=>array('admin')),
);
?>

<h1>Networks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
