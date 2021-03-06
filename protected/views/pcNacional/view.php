<?php
/* @var $this PcNacionalController */
/* @var $model PcNacional */

if($tipo == Yii::app()->params->pc_comercial){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacional/adminCom';
}

if($tipo == Yii::app()->params->pc_administrativo){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacional/adminAdm';
}

if($tipo == Yii::app()->params->pc_fiscal){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacional/adminFis';
}

if($tipo == Yii::app()->params->pc_regulatorio){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacional/adminReg';
}

if($tipo == Yii::app()->params->pc_laboral){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacional/adminLab';
}

?>

<h3>Visualizando registro</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Pc_Nacional',
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
        array(
            'name'=>'Area',
            'value' => $model->area->Area,
        ),
        array(
            'name'=>'num_anex',
            'value'=>$model->Num_Anex($model->Id_Pc_Nacional),
        ),
		'Actividad',
		'Evidencia_Cumplimiento',
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
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo $url; ?>';"><i class="fa fa-reply"></i> Volver </button>
</div>


