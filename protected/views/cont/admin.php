<?php
/* @var $this ContController */
/* @var $model Cont */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('fast');
	return false;
});
$('.search-form form').submit(function(){
	$('#cont-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

//para combos de tipos de periodicidad
$lista_period = CHtml::listData($period, 'Id_Dominio', 'Dominio');

?>

<h3>Panel de control contratos</h3>

<div class="btn-group" style="padding-bottom: 2%">
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=cont/create'; ?>';"><i class="fa fa-plus"></i> Nuevo registro</button>
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
    'lista_empresas' => $lista_empresas,
    'lista_period' => $lista_period,
)); ?>
</div><!-- search-form -->




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cont-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		'Id_Contrato',
		array(
            'name'=>'Empresa',
            'value'=>'$data->empresa->Descripcion',
        ),
		'Proveedor',
		'Concepto_Contrato',
        array(
            'name'=>'Periodicidad',
            'value'=>'$data->periodicidad->Dominio',
        ),
		'Area',
        array(
            'name' => 'vlr_cont',
            'value' => '$data->VlrCont($data->Id_Contrato)',
            'htmlOptions'=>array('style' => 'text-align: right;'),
        ),
        /*array(
            'name'=>'Vlr_Contrato',
            'value'=>function($data){
                return number_format($data->Vlr_Contrato, 0);
            },
            'htmlOptions'=>array('style' => 'text-align: right;'),
        ),*/
		array(
            'name'=>'Fecha_Inicial',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Inicial)',
        ),
		array(
            'name'=>'Fecha_Final',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Final)',
        ),
        array(
            'name'=>'Fecha_Ren_Can',
            'value'=>'UtilidadesVarias::textofecha($data->Fecha_Ren_Can)',
            'cssClassExpression' => 'UtilidadesVarias::estadofechavencimiento(6, $data->Id_Contrato)',
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
  var url = "<?php echo Yii::app()->createUrl('Cont/ViewRes'); ?>";
  $('.modal-body').load(url,function(){
    $('#myModal').modal({show:true});
    $('.ajax-loader').fadeOut('fast');
  });

});

function filtro(valor){
    $('.ajax-loader').fadeIn('fast');
    $('#Cont_view').val(valor).trigger('change');
    $('#yt0').click();
    $('#myModal').modal('toggle');
    $('.search-form').toggle('fast');
    setTimeout(function(){ $('.ajax-loader').fadeOut('fast'); }, 3000);
}

</script>