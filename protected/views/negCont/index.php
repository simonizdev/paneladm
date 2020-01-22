<?php
/* @var $this NegContController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Neg Conts',
);

$this->menu=array(
	array('label'=>'Create NegCont', 'url'=>array('create')),
	array('label'=>'Manage NegCont', 'url'=>array('admin')),
);
?>

<h1>Neg Conts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
