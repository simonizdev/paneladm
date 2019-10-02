<?php
/* @var $this PcExteriorController */
/* @var $model PcExterior */

?>

<h3>Visualizando registro</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Pc_Ext',
		array(
            'name'=>'Empresa',
            'value'=>$model->empresa->Descripcion,
        ),
        'Descripcion',
        array(
            'name'=>'Periodicidad',
            'value'=>$model->periodicidad->Dominio,
        ),
        array(
            'name'=>'Fecha_Inicial',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Inicial),
        ),
        array(
            'name'=>'Fecha_Final',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Final),
        ),
        'Area',  
        'Actividad',
        'Evidencia_Cumplimiento',
        'Observaciones',
        array(
            'name'=>'num_anex',
            'value'=>$model->Num_Anex($model->Id_Pc_Ext),
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
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcExterior/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>
