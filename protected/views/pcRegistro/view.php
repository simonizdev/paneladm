<?php
/* @var $this PcRegistroController */
/* @var $model PcRegistro */

?>

<h3>Visualizando registro</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Pc_Registro',
		array(
            'name'=>'Empresa',
            'value'=>$model->empresa->Descripcion,
        ),
		'Marca',
		'Origen',
		array(
            'name'=>'Fecha_Inicial',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Inicial),
        ),
        array(
            'name'=>'Fecha_Final',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Final),
        ),
		'Descripcion',
		'Variedad_Registro',
		'Expediente',
		'Evidencia_Cumplimiento',
		'Observaciones',
		array(
            'name'=>'num_anex',
            'value'=>$model->Num_Anex($model->Id_Pc_Registro),
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

<div class="btn-group">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=PcRegistro/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>
