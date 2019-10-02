<?php
/* @var $this PcProcJurController */
/* @var $model PcProcJur */

?>

<h3>Visualizando registro</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Pc_Proc_Jur',
		'Demandante',
		'Demandados',
		'Abogado',
		'Tipo_Proceso',
		array(
            'name'=>'Fecha_Admision',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Admision),
        ),
        array(
            'name'=>'Fecha_Contestacion',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Contestacion),
        ),
		'Radicado',
		'Autoridad',
        'Observaciones',
        array(
            'name'=>'num_act',
            'value'=>$model->Num_Act($model->Id_Pc_Proc_Jur),
        ),
		'Dias_Alerta',
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcProcJur/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>

