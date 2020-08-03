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
  <div class="col-sm-12">
    <div class="form-group">
      <?php echo $form->error($model,'ips', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'ips'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Network[ips]',
              'id'=>'Network_ips',
              'data'=>$lista_ips_disp,
              'htmlOptions'=>array(
                  'multiple'=>'multiple',
              ),
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=network/admin'; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-floppy-o"></i> Guardar</button>
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

    			$('#buttons').hide();
                $(".ajax-loader").fadeIn('fast');
    			form.submit();
	  	                
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

function clear_select2_ajax(id){
  $('#'+id+'').val('').trigger('change');
  $('#s2id_'+id+' span').html("");
}
	
</script>