<?php
/* @var $this PcNacionalAnexoController */
/* @var $model PcNacionalAnexo */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('fast');
	return false;
});
$('.search-form form').submit(function(){
	$('#pc-nacional-anexo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

//para combos de tipos de tipos
$lista_tipos = CHtml::listData($tipos, 'Id_Dominio', 'Dominio');

?>

<h3>Administración de anexos por control nacional (consolidado)</h3>

<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_searchall',array(
	'model'=>$model,
    'lista_tipos'=>$lista_tipos,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pc-nacional-anexo-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		'Id_Anexo_Pc_Nacional',
		array(
            'name'=>'Id_Pc_Nacional',
            'value'=>'$data->Desc_Pc_Nacional($data->Id_Pc_Nacional)',
        ),
        array(
            'name' => 'Tipo',
            'value' => '$data->tipo->Dominio',
        ),
		'Titulo',
		'Descripcion',
		array(
            'name' => 'Estado',
            'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'<i class="fa fa-eye actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Visualizar'),
                    'url'=>'Yii::app()->createUrl("pcNacionalAnexo/viewall", array("id"=>$data->Id_Anexo_Pc_Nacional))',
                ),
            )
		),
	),
)); ?>
