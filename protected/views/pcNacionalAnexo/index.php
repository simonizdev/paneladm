<?php
/* @var $this PcNacionalAnexoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pc Nacional Anexos',
);

$this->menu=array(
	array('label'=>'Create PcNacionalAnexo', 'url'=>array('create')),
	array('label'=>'Manage PcNacionalAnexo', 'url'=>array('admin')),
);
?>

<h1>Pc Nacional Anexos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
