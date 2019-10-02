<?php
/* @var $this PcNacionalAnexoController */
/* @var $model PcNacionalAnexo */

if($tipo == Yii::app()->params->pc_comercial){
    $titulo = '(comercial)';
}

if($tipo == Yii::app()->params->pc_administrativo){
    $titulo = '(administrativo)';
}

if($tipo == Yii::app()->params->pc_fiscal){
    $titulo = '(fiscal)';
}

if($tipo == Yii::app()->params->pc_regulatorio){
    $titulo = '(regulatorio)';
}

if($tipo == Yii::app()->params->pc_laboral){
    $titulo = '(laboral)';
}

?>

<h3>Actualizando anexo de control nacional <?php echo $titulo; ?></h3>

<?php $this->renderPartial('_form2', array('model'=>$model, 'tipo'=>$tipo)); ?>