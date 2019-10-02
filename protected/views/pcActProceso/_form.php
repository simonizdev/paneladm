<?php
/* @var $this PcActProcesoController */
/* @var $model PcActProceso */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pc-act-proceso-form',
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
  	<div class="col-sm-8">
      	<div class="form-group">
      		<?php echo $form->error($model,'Id_Proceso', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Id_Proceso'); ?>
      		<?php echo $form->textField($model,'Id_Proceso'); ?>
      		<?php
            $this->widget('ext.select2.ESelect2', array(
                'selector' => '#PcActProceso_Id_Proceso',
                'options'  => array(
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'width' => '100%',
                    'language' => 'es',
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('PcActProceso/SearchProceso'),
                        'dataType'=>'json',
                        'data'=>'js:function(term){return{q: term};}',
                        'results'=>'js:function(data){ return {results:data};}'                   
                    ),
                    'formatNoMatches'=> 'js:function(){ clear_select2_ajax("PcActProceso_Id_Proceso"); return "No se encontraron resultados"; }',
                    'formatInputTooShort' =>  'js:function(){ return "Digite más de 3 caracteres para iniciar busqueda <button type=\"button\" class=\"btn btn-success btn-xs pull-right\" onclick=\"clear_select2_ajax(\'PcActProceso_Id_Proceso\')\">Limpiar campo</button>"; }',
                    'initSelection'=>'js:function(element,callback) {
                        var id=$(element).val(); // read #selector value
                        if ( id !== "" ) {
                          $.ajax("'.Yii::app()->createUrl('PcActProceso/SearchProcesoById').'", {
                              data: { id: id },
                              dataType: "json"
                          }).done(function(data,textStatus, jqXHR) { callback(data[0]); });
                       }
                    }',
                ),
            ));
          	?>
      	</div>
  	</div>
	<div class="col-sm-4">
    	<div class="form-group">
        	<?php echo $form->error($model,'Fecha_Inicial', array('class' => 'pull-right badge bg-red')); ?>
        	<?php echo $form->label($model,'Fecha_Inicial'); ?>
        	<?php echo $form->textField($model,'Fecha_Inicial', array('class' => 'form-control', 'readonly' => true)); ?>
    	</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
    	<div class="form-group">
        	<?php echo $form->error($model,'Fecha_Final', array('class' => 'pull-right badge bg-red')); ?>
        	<?php echo $form->label($model,'Fecha_Final'); ?>
        	<?php echo $form->textField($model,'Fecha_Final', array('class' => 'form-control', 'readonly' => true)); ?>
    	</div>
	</div>
	<div class="col-sm-4">
    	<div class="form-group">
            <?php echo $form->error($model,'Observaciones', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Observaciones'); ?>
            <?php echo $form->textArea($model,'Observaciones',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
    	</div>
	</div>
	<div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = Yii::app()->params->estados; ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcActProceso[Estado]',
                    'id'=>'PcActProceso_Estado',
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

<div class="btn-group" id="buttons">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcActProceso/admin'; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php if($model->isNewRecord){echo 'Crear';}else{ echo 'Guardar';} ?></button>
</div>

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

	$("#PcActProceso_Fecha_Inicial").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var minDate = new Date(selected.date.valueOf());
	   $('#PcActProceso_Fecha_Final').datepicker('setStartDate', minDate);
	});

	$("#PcActProceso_Fecha_Final").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var maxDate = new Date(selected.date.valueOf());
	   $('#PcActProceso_Fecha_Inicial').datepicker('setEndDate', maxDate);
	});


});

	
</script>
