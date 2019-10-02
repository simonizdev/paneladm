<?php
/* @var $this PcActProcesoController */
/* @var $model PcActProceso */

?>

<h3>Visualizando contrato</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'Id_Pc_Act_Proceso',
        array(
            'name'=>'Id_Proceso',
            'value'=>$model->Desc_Proceso($model->Id_Proceso),
        ),
		array(
            'name'=>'Fecha_Inicial',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Inicial),
        ),
        array(
            'name'=>'Fecha_Final',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Final),
        ),
		'Observaciones',
        array(
            'name' => 'Estado',
            'value' => UtilidadesVarias::textoestado1($model->Estado),
        ),
		array(
            'name'=>'Id_Usuario_Creacion',
            'value'=>$model->idusuariocre->Usuario,
        ),
        array(
            'name'=>'Fecha_Creacion',
            'value'=>UtilidadesVarias::textofechahora($model->Fecha_Creacion),
        ),
        array(
            'name'=>'Id_Usuario_Actualizacion',
            'value'=>$model->idusuarioact->Usuario,
        ),
        array(
            'name'=>'Fecha_Actualizacion',
            'value'=>UtilidadesVarias::textofechahora($model->Fecha_Actualizacion),
        ),		
	),
)); ?>

</div>

<div class="btn-group">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcActProceso/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>

