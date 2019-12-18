<?php
/* @var $this FactItemContController */
/* @var $model FactItemCont */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fact-item-cont-form',
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
          	<?php echo $form->error($model,'Id_Contrato', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'Id_Contrato'); ?>
			<?php echo $form->hiddenField($model,'Id_Contrato', array('class' => 'form-control', 'value' => $c)); ?>
			<?php  
				$mc = new Cont;
				$desc_cont = $mc->Desccontrato($c);
				echo '<p>'.$desc_cont.'</p>';
			?>          
        </div>
    </div>
    <div class="col-sm-4">
      	<div class="form-group">
			<?php echo $form->error($model,'Numero_Factura', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Numero_Factura'); ?>
      		<?php echo $form->textField($model,'Numero_Factura', array('class' => 'form-control', 'maxlength' => '50', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
</div>
<div class="row">
	<div class="col-sm-4">
	  	<div class="form-group">
	        <?php echo $form->error($model,'Fecha_Factura', array('class' => 'pull-right badge bg-red')); ?>
	        <?php echo $form->label($model,'Fecha_Factura'); ?>
	        <?php echo $form->textField($model,'Fecha_Factura', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
	  	</div>
	</div>

  	<div class="col-sm-8">
      	<div class="form-group">
  			<?php echo $form->error($model,'Items', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'Items'); ?>
			<?php
			  $this->widget('ext.select2.ESelect2',array(
			      'name'=>'FactItemCont[Items]',
			      'id'=>'FactItemCont_Items',
			      'data'=>$lista_items,
			      'value'=>explode(",", $model->Items),
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
<div class="row">
	<div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = array(0 => 'ANULADA', 1 => 'RECIBIDA') ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'FactItemCont[Estado]',
                    'id'=>'FactItemCont_Estado',
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=cont/view&id='.$c; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-floppy-o"></i> <?php if($model->isNewRecord){echo 'Crear';}else{ echo 'Guardar';} ?></button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">


$(function() {

	$("#valida_form").click(function() {
      var form = $("#fact-item-cont-form");
      var settings = form.data('settings') ;

      settings.submitting = true ;
      $.fn.yiiactiveform.validate(form, function(messages) {
          if($.isEmptyObject(messages)) {
              $.each(settings.attributes, function () {
                 $.fn.yiiactiveform.updateInput(this,messages,form); 
              });
              	
              $('#buttons').hide();
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

	
</script>