<?php
/* @var $this PcContratoController */
/* @var $model PcContrato */

?>

<h3>Visualizando contrato</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'Id_Pc_Contrato',
		array(
            'name'=>'Empresa',
            'value'=>$model->empresa->Descripcion,
        ),
		'Proveedor',
		'Concepto_Contrato',
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
        array(
            'name'=>'Fecha_Ren_Can',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Ren_Can),
        ),
        array(
            'name'=>'Vlr_Contrato',
            'value'=>function($model){
                return number_format($model->Vlr_Contrato, 0);
            },
        ),
		'Area',
        array(
            'name'=>'num_doc',
            'value'=>$model->Num_Doc($model->Id_Pc_Contrato),
        ),
		'Observaciones',
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcContrato/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>


