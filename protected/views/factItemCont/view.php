<?php
/* @var $this FactItemContController */
/* @var $model FactItemCont */

?>

<h3>Visualizando factura de contrato</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Fac',
		array(
            'name'=>'Id_Contrato',
            'value'=>$model->DescContrato($model->Id_Contrato),
        ),
		'Items',
		'Numero_Factura',
		array(
            'name'=>'Fecha_Factura',
            'value'=>UtilidadesVarias::textofechahora($model->Fecha_Factura),
        ),
		array(
            'name' => 'Estado',
            'value' => $model->DescEstado($model->Estado),
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

<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=cont/view&id='.$model->Id_Contrato; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>
