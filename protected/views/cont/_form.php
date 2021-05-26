<?php
/* @var $this ContController */
/* @var $model Cont */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cont-form',
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
            <?php echo $form->error($model,'Tipo', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Tipo'); ?>
            <?php $lista_tipos = array(1 => 'CLIENTE', 2 => 'PROVEEDOR'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'Cont[Tipo]',
                    'id'=>'Cont_Tipo',
                    'data'=>$lista_tipos,
                    'value' => $model->Tipo,
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
            <?php echo $form->error($model,'Empresa', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Empresa'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'Cont[Empresa]',
                    'id'=>'Cont_Empresa',
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
      		<?php echo $form->error($model,'Razon_Social', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Razon_Social'); ?>
      		<?php echo $form->textField($model,'Razon_Social', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
</div>
<div class="row">
  	<div class="col-sm-4">
      	<div class="form-group">
      		<?php echo $form->error($model,'Concepto_Contrato', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Concepto_Contrato'); ?>
      		<?php echo $form->textField($model,'Concepto_Contrato', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
 	  <div class="col-sm-4">
      	<div class="form-group">
      		<?php echo $form->error($model,'Contacto', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Contacto'); ?>
      		<?php echo $form->textField($model,'Contacto', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
  	<div class="col-sm-4">
      	<div class="form-group">
      		<?php echo $form->error($model,'Telefono_Contacto', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Telefono_Contacto'); ?>
      		<?php echo $form->textField($model,'Telefono_Contacto', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
</div>
<div class="row">
  	<div class="col-sm-4">
      	<div class="form-group">
      		<?php echo $form->error($model,'Email_Contacto', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Email_Contacto'); ?>
      		<?php echo $form->textField($model,'Email_Contacto', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off')); ?>
      	</div>
  	</div>
    <div class="col-sm-4">
    <div class="form-group">
          <?php echo $form->error($model,'Periodicidad', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Periodicidad'); ?>
          <?php
              $this->widget('ext.select2.ESelect2',array(
                  'name'=>'Cont[Periodicidad]',
                  'id'=>'Cont_Periodicidad',
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
  <div class="col-sm-4">
      <div class="form-group">
          <?php echo $form->error($model,'Area', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Area'); ?>
          <?php echo $form->textField($model,'Area', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
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
          <?php echo $form->error($model,'Dias_Alerta', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Dias_Alerta'); ?>
          <?php echo $form->numberField($model,'Dias_Alerta', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">
      <div class="form-group">
          <?php echo $form->error($model,'Fecha_Ren_Can', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Fecha_Ren_Can'); ?>
          <?php echo $form->textField($model,'Fecha_Ren_Can', array('class' => 'form-control', 'readonly' => true)); ?>
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
                    'name'=>'Cont[Estado]',
                    'id'=>'Cont_Estado',
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=Cont/admin'; ?>';"><i class="fa fa-reply"></i> Volver</button>
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

	$("#Cont_Fecha_Inicial").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var minDate = new Date(selected.date.valueOf());
	   $('#Cont_Fecha_Final').datepicker('setStartDate', minDate);
	});

	$("#Cont_Fecha_Final").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var maxDate = new Date(selected.date.valueOf());
	   $('#PcContrato_Fecha_Inicial').datepicker('setEndDate', maxDate);
     calcfecrencan();
	});

  $("#Cont_Dias_Alerta").change(function() {
    calcfecrencan();
  });

  function calcfecrencan(){
    var fecha_final = $("#Cont_Fecha_Final").val();
    var dias_ant = $("#Cont_Dias_Alerta").val();

    if(fecha_final != "" && dias_ant != ""){

      fecha_ren_can = moment(fecha_final).subtract(dias_ant,'days').format('YYYY-MM-DD');

      $("#Cont_Fecha_Ren_Can").val(fecha_ren_can); 

    }else{
      $("#Cont_Fecha_Ren_Can").val(''); 
    }
  }

});




	
</script>