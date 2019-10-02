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
?>

<h3>Administración de anexos por control nacional (fiscal)</h3>

<div class="btn-group" style="padding-bottom: 2%">
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcNacionalAnexo/create&tipo='.$tipo; ?>';"><i class="fa fa-plus"></i> Nuevo registro</button>
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
    'tipo'=>Yii::app()->params->pc_fiscal,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pc-nacional-anexo-grid',
	'dataProvider'=>$model->searchfis(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		'Id_Anexo_Pc_Nacional',
		array(
            'name'=>'Id_Pc_Nacional',
            'value'=>'$data->Desc_Pc_Nacional($data->Id_Pc_Nacional)',
        ),
		'Titulo',
		'Descripcion',
		array(
            'name' => 'Estado',
            'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'<i class="fa fa-eye actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Visualizar'),
                    'url'=>'Yii::app()->createUrl("pcNacionalAnexo/view", array("id"=>$data->Id_Anexo_Pc_Nacional, "tipo"=>Yii::app()->params->pc_fiscal))',
                ),
                'update'=>array(
                    'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Actualizar'),
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    'url'=>'Yii::app()->createUrl("pcNacionalAnexo/update", array("id"=>$data->Id_Anexo_Pc_Nacional, "tipo"=>Yii::app()->params->pc_fiscal))',
                ),
            )
		),
	),
)); ?>
