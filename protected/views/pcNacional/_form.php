<?php
/* @var $this PcNacionalController */
/* @var $model PcNacional */
/* @var $form CActiveForm */

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

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pc-nacional-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Empresa', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Empresa'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcNacional[Empresa]',
                    'id'=>'PcNacional_Empresa',
                    'data'=>$lista_empresas,
                    'value' => $model->Empresa,
                    'htmlOptions'=>array(),
                    'options'=>array(
                        'placeholder'=>'Seleccione...',
                        'width'=> '100%',
                        'allowClear'=>true,
                    ),
                ));
            ?>  
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Descripcion', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Descripcion'); ?>
            <?php echo $form->textField($model,'Descripcion', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
        </div>
    </div>
    <div class="col-sm-4">
    	<div class="form-group">
            <?php echo $form->error($model,'Periodicidad', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Periodicidad'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcNacional[Periodicidad]',
                    'id'=>'PcNacional_Periodicidad',
                    'data'=>$lista_period,
                    'value' => $model->Periodicidad,
                    'htmlOptions'=>array(),
                    'options'=>array(
                        'placeholder'=>'Seleccione...',
                        'width'=> '100%',
                        'allowClear'=>true,
                    ),
                ));
            ?>  
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Fecha_Inicial', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Fecha_Inicial'); ?>
            <?php echo $form->textField($model,'Fecha_Inicial', array('class' => 'form-control', 'readonly' => true)); ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Fecha_Final', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Fecha_Final'); ?>
            <?php echo $form->textField($model,'Fecha_Final', array('class' => 'form-control', 'readonly' => true)); ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Area', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Area'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcNacional[Area]',
                    'id'=>'PcNacional_Area',
                    'data'=>$lista_areas,
                    'value' => $model->Area,
                    'htmlOptions'=>array(),
                    'options'=>array(
                        'placeholder'=>'Seleccione...',
                        'width'=> '100%',
                        'allowClear'=>true,
                    ),
                ));
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Actividad', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Actividad'); ?>
            <?php echo $form->textArea($model,'Actividad',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Evidencia_Cumplimiento', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Evidencia_Cumplimiento'); ?>
            <?php echo $form->textArea($model,'Evidencia_Cumplimiento',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Observaciones', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Observaciones'); ?>
            <?php echo $form->textArea($model,'Observaciones',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Dias_Alerta', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Dias_Alerta'); ?>
            <?php echo $form->numberField($model,'Dias_Alerta', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = Yii::app()->params->estados; ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcNacional[Estado]',
                    'id'=>'PcNacional_Estado',
                    'data'=>$estados,
                    'value' => $model->Estado,
                    'htmlOptions'=>array(),
                    'options'=>array(
                        'placeholder'=>'Seleccione...',
                        'width'=> '100%',
                        'allowClear'=>true,
                    ),
                ));
            ?>
        </div>
    </div>   
</div>

<div class="btn-group">
    <button type="button" class="btn btn-success"  onclick="location.href = '<?php echo $url; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> <?php if($model->isNewRecord){echo 'Crear';}else{ echo 'Guardar';} ?></button>
</div>

<!-- /.row -->

<?php $this->endWidget(); ?>

<script type="text/javascript">

$(function() {	

	//variables para el lenguaje del datepicker
	$.fn.datepicker.dates['es'] = {
	  days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
	  daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
	  daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
	  months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
	  monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
	  today: "Hoy",
	  clear: "Limpiar",
	  format: "yyyy-mm-dd",
	  titleFormat: "MM yyyy",
	  weekStart: 1
	};

	$("#PcNacional_Fecha_Inicial").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var minDate = new Date(selected.date.valueOf());
	   $('#PcNacional_Fecha_Final').datepicker('setStartDate', minDate);
	});

	$("#PcNacional_Fecha_Final").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var maxDate = new Date(selected.date.valueOf());
	   $('#PcNacional_Fecha_Inicial').datepicker('setEndDate', maxDate);
	}); 

});

</script>

