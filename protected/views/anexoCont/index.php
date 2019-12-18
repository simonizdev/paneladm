<?php
/* @var $this AnexoContController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Anexo Conts',
);

$this->menu=array(
	array('label'=>'Create AnexoCont', 'url'=>array('create')),
	array('label'=>'Manage AnexoCont', 'url'=>array('admin')),
);
?>

<h1>Anexo Conts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
