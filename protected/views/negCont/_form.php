<?php
/* @var $this NegContController */
/* @var $model NegCont */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'neg-cont-form',
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
    <div class="col-sm-8">
      <div class="form-group">
            <?php echo $form->error($model,'Item', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Item'); ?>
            <?php echo $form->textArea($model,'Item',array('class' => 'form-control', 'rows'=>3, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
      </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-4">
    	<div class="form-group">
    		<?php echo $form->error($model,'Costo', array('class' => 'pull-right badge bg-red')); ?>
          	<?php echo $form->label($model,'Costo'); ?>
		    <?php echo $form->numberField($model,'Costo', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <?php echo $form->error($model,'Moneda', array('class' => 'pull-right badge bg-red')); ?>
        <?php echo $form->label($model,'Moneda'); ?>
        <?php $estados = Yii::app()->params->estados; ?>
        <?php
            $this->widget('ext.select2.ESelect2',array(
                'name'=>'NegCont[Moneda]',
                'id'=>'NegCont_Moneda',
                'data'=>$lista_monedas,
                'value' => $model->Moneda,
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
            <?php echo $form->error($model,'Porc_Desc', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Porc_Desc'); ?>
            <?php echo $form->numberField($model,'Porc_Desc', array('class' => 'form-control', 'autocomplete' => 'off', 'step' => '0.01', 'min' => '0.00', 'placeholder' => '0,00', 'value' => number_format($model->Porc_Desc, 2))); ?>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model,'costo_final'); ?>
            <?php echo '<p id="costo_final">-</p>'; ?>
        </div>
    </div>     
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = Yii::app()->params->estados; ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'NegCont[Estado]',
                    'id'=>'NegCont_Estado',
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
      var form = $("#neg-cont-form");
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

$("#NegCont_Costo").change(function() {
  var costo = $(this).val();
  var porc_desc = $('#NegCont_Porc_Desc').val();

  if(costo != "" && porc_desc){
      
    var data = {costo: costo, porc_desc: porc_desc}
    $.ajax({ 
        type: "POST", 
        url: "<?php echo Yii::app()->createUrl('negCont/costofinal'); ?>",
        data: data,
        success: function(response){
           $('#costo_final').text(response);
        }
    });

  }else{
    $('#costo_final').text('-');
  }

});

$("#NegCont_Porc_Desc").change(function() {
  var costo = $('#NegCont_Costo').val();
  var porc_desc = $(this).val();

  if(costo != "" && porc_desc){

    var data = {costo: costo, porc_desc: porc_desc}
    $.ajax({ 
        type: "POST", 
        url: "<?php echo Yii::app()->createUrl('negCont/costofinal'); ?>",
        data: data,
        success: function(response){
           $('#costo_final').text(response);
        }
    });

  }else{
    $('#costo_final').text('-');
  }

});
	
</script>