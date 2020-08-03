<?php
/* @var $this NetworkController */
/* @var $model Network */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'network-form',
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
			<?php echo $form->error($model,'id_red_1', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'id_red_1'); ?>
			<?php echo $form->numberField($model,'id_red_1', array('class' => 'form-control', 'min' => '0', 'max' => '999', 'step' => '1', 'autocomplete' => 'off')); ?>
		</div>	
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<?php echo $form->error($model,'id_red_2', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'id_red_2'); ?>
			<?php echo $form->numberField($model,'id_red_2', array('class' => 'form-control', 'min' => '0', 'max' => '999', 'step' => '1', 'autocomplete' => 'off')); ?>
		</div>	
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<?php echo $form->error($model,'Segment', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'Segment'); ?>
			<?php echo $form->numberField($model,'Segment', array('class' => 'form-control', 'min' => '0', 'max' => '999', 'step' => '1', 'autocomplete' => 'off')); ?>
		</div>	
	</div>
</div>

<div class="btn-group" id="buttons">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=network/admin'; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-floppy-o"></i> <?php if($model->isNewRecord){echo 'Crear';}else{ echo 'Guardar';} ?></button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

$(function() {

	$("#valida_form").click(function() {
      var form = $("#network-form");
      var settings = form.data('settings') ;
      settings.submitting = true ;
      $.fn.yiiactiveform.validate(form, function(messages) {
          if($.isEmptyObject(messages)) {
	            $.each(settings.attributes, function () {
	                $.fn.yiiactiveform.updateInput(this,messages,form); 
	            });

	            var id_1 = $('#Network_id_red_1').val();
	            var id_2 = $('#Network_id_red_2').val();
	            var segment = $('#Network_Segment').val();
              	
                var data = {id_1: id_1, id_2: id_2, segment: segment}
	  	        $.ajax({ 
	  	            type: "POST", 
	  	            url: "<?php echo Yii::app()->createUrl('network/existsegment'); ?>",
	  	            data: data,
	  	            success: function(response){

	  	                if(response == 0){
	  	                    //se encontro un segmento existente
	  	                    $('#Network_Segment_em_').html('Esta red ya esta registrada.');
	  	                    $('#Network_Segment_em_').show();
	  	                }

	  	                if(response == 1){
	  	                    //si el segmento no existe
	  	                    $.each(settings.attributes, function () {
				                $.fn.yiiactiveform.updateInput(this,messages,form); 
				            });
	            			$('#buttons').hide();
	                        $(".ajax-loader").fadeIn('fast');
	            			form.submit();
	  	                }

	  	            }
	  	        });

          } else {
              settings = form.data('settings'),
              $.each(settings.attributes, function () {
                 $.fn.yiiactiveform.updateInput(this,messages,form); 
              });
              settings.submitting = false ;
          }
      });
  	});

});

</script>