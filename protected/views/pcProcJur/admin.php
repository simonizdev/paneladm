<?php
/* @var $this PcProcJurController */
/* @var $model PcProcJur */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('fast');
	return false;
});
$('.search-form form').submit(function(){
	$('#pc-proc-jur-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Panel de control procesos jurídicos</h3>

<div class="btn-group" style="padding-bottom: 2%">
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcProcJur/create'; ?>';"><i class="fa fa-plus"></i> Nuevo registro</button>
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pc-proc-jur-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		'Id_Pc_Proc_Jur',
		'Demandante',
		'Demandados',
		'Abogado',
		'Tipo_Proceso',
        array(
            'name'=>'num_act',
            'value'=>'$data->Num_Act($data->Id_Pc_Proc_Jur)',
        ),
		array(
            'name'=>'Fecha_Admision',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Admision)',
        ),
		array(
            'name'=>'Fecha_Contestacion',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Contestacion)',
            'cssClassExpression' => 'UtilidadesVarias::estadofechavencimiento(3, $data->Id_Pc_Proc_Jur)',
        ),
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
                ),
                'update'=>array(
                    'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Actualizar'),
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
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
  var url = "<?php echo Yii::app()->createUrl('PcProcJur/ViewRes'); ?>";
  $('.modal-body').load(url,function(){
    $('#myModal').modal({show:true});
    $('.ajax-loader').fadeOut('fast');
  });

});

function filtro(valor){
    $('.ajax-loader').fadeIn('fast');
    $('#PcProcJur_view').val(valor).trigger('change');
    $('#yt0').click();
    $('#myModal').modal('toggle');
    $('.search-form').toggle('fast');
    setTimeout(function(){ $('.ajax-loader').fadeOut('fast'); }, 3000);
}


</script>

