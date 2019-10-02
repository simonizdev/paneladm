<?php
/* @var $this LicenciaCompController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Licencia Comps',
);

$this->menu=array(
	array('label'=>'Create LicenciaComp', 'url'=>array('create')),
	array('label'=>'Manage LicenciaComp', 'url'=>array('admin')),
);
?>

<h1>Licencia Comps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
