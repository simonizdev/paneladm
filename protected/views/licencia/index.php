<?php
/* @var $this LicenciaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Licencias',
);

$this->menu=array(
	array('label'=>'Create Licencia', 'url'=>array('create')),
	array('label'=>'Manage Licencia', 'url'=>array('admin')),
);
?>

<h1>Licencias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
