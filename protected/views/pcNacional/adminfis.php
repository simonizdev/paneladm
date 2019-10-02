<?php
/* @var $this PcNacionalController */
/* @var $model PcNacional */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('fast');
	return false;
});
$('.search-form form').submit(function(){
	$('#pc-nacional-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

//para combos de áreas
$lista_areas = CHtml::listData($areas, 'Id_Area', 'Area');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

//para combos de tipos de periodicidad
$lista_period = CHtml::listData($period, 'Id_Dominio', 'Dominio')

?>

<h3>Panel de control nacional (Fiscal)</h3>

<div class="btn-group" style="padding-bottom: 2%">
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcNacional/create&tipo='.$tipo; ?>';"><i class="fa fa-plus"></i> Nuevo registro</button>
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
    'lista_areas' => $lista_areas,
    'lista_empresas' => $lista_empresas,
    'lista_period' => $lista_period,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pc-nacional-grid',
	'dataProvider'=>$model->searchfis(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		'Id_Pc_Nacional',
        array(
            'name'=>'Empresa',
            'value'=>'$data->empresa->Descripcion',
        ),
        'Descripcion',
        array(
            'name'=>'Periodicidad',
            'value'=>'$data->periodicidad->Dominio',
        ),
        'Actividad',
        array(
            'name'=>'Area',
            'value' => '$data->area->Area',
        ),
        array(
            'name'=>'num_anex',
            'value'=>'$data->Num_Anex($data->Id_Pc_Nacional)',
        ),
        array(
            'name'=>'Fecha_Inicial',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Inicial)',
        ),
        array(
            'name'=>'Fecha_Final',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Final)',
            'cssClassExpression' => 'UtilidadesVarias::estadofechavencimiento(1, $data->Id_Pc_Nacional)',
        ),
        array(
            'name' => 'Estado',
            'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
        ),
        //'Evidencia_Cumplimiento',
        //'Observaciones',
        //'Id_Usuario_Creacion',
        //'Fecha_Creacion',
        //'Id_Usuario_Actualizacion',
        //'Fecha_Actualización',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'<i class="fa fa-eye actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Visualizar'),
                    'url'=>'Yii::app()->createUrl("pcNacional/view", array("id"=>$data->Id_Pc_Nacional, "tipo"=>Yii::app()->params->pc_fiscal))',
                ),
                'update'=>array(
                    'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Actualizar'),
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    'url'=>'Yii::app()->createUrl("pcNacional/update", array("id"=>$data->Id_Pc_Nacional, "tipo"=>Yii::app()->params->pc_fiscal))',
                ),
            )
        ),
	),
)); ?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<script>

$(function() {
  $('.ajax-loader').fadeIn('fast');  
  var url = "<?php echo Yii::app()->createUrl('PcNacional/ViewRes&opc=3'); ?>";
  $('.modal-body').load(url,function(){
    $('#myModal').modal({show:true});
    $('.ajax-loader').fadeOut('fast');
  });

});

function filtro(valor){
    $('.ajax-loader').fadeIn('fast');
    $('#PcNacional_view').val(valor).trigger('change');
    $('#yt0').click();
    $('#myModal').modal('toggle');
    $('.search-form').toggle('fast');
    setTimeout(function(){ $('.ajax-loader').fadeOut('fast'); }, 3000);
}


</script>
