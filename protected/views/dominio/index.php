<?php
/* @var $this DominioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dominios',
);

$this->menu=array(
	array('label'=>'Create Dominio', 'url'=>array('create')),
	array('label'=>'Manage Dominio', 'url'=>array('admin')),
);
?>

<h1>Dominios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
