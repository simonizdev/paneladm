<?php
/* @var $this EquipoAntivirusController */
/* @var $model EquipoAntivirus */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipo-antivirus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data'
	),
)); ?>

<div class="row">
 	<div class="col-sm-4">
    	<?php echo $form->label($model,'Id_Equipo'); ?>
        <?php echo '<p>'.UtilidadesVarias::descequipo($e).'</p>'; ?>     
    </div>
  	<div class="col-sm-4">
    	<div class="form-group">
            <?php echo $form->error($model,'Tipo_Licencia', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Tipo_Licencia'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'EquipoAntivirus[Tipo_Licencia]',
                    'id'=>'EquipoAntivirus_Tipo_Licencia',
                    'data'=>$tipos_licencia,
                    'value' => $model->Tipo_Licencia,
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
            <?php echo $form->error($model,'Version', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Version'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'EquipoAntivirus[Version]',
                    'id'=>'EquipoAntivirus_Version',
                    'data'=>$versiones_antivirus,
                    'value' => $model->Version,
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
      		<?php echo $form->error($model,'Num_Licencia', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Num_Licencia'); ?>
      		<?php echo $form->textField($model,'Num_Licencia', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>	
  	</div>
  	<div class="col-sm-4">
    	<div class="form-group">
      		<?php echo $form->error($model,'Num_Usuario', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Num_Usuario'); ?>
      		<?php echo $form->textField($model,'Num_Usuario', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>	
  	</div>
  	<div class="col-sm-4">
    	<div class="form-group">
      		<?php echo $form->error($model,'Password', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Password'); ?>
      		<?php echo $form->textField($model,'Password', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>	
  	</div>
</div>
<div class="row">
  	<div class="col-sm-4">
		<div class="form-group">
			<?php echo $form->error($model,'Notas', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'Notas'); ?>
			<?php echo $form->textArea($model,'Notas',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
		</div>
	</div>    
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Empresa_Compra', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Empresa_Compra'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'EquipoAntivirus[Empresa_Compra]',
                    'id'=>'EquipoAntivirus_Empresa_Compra',
                    'data'=>$lista_empresas,
                    'value' => $model->Empresa_Compra,
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
            <?php echo $form->error($model,'Proveedor', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Proveedor'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'EquipoAntivirus[Proveedor]',
                    'id'=>'EquipoAntivirus_Proveedor',
                    'data'=>$lista_proveedores,
                    'value' => $model->Proveedor,
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
          <?php echo $form->error($model,'Numero_Factura', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Numero_Factura'); ?>
          <?php echo $form->textField($model,'Numero_Factura', array('class' => 'form-control', 'maxlength' => '50', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
        </div>
    </div>
    <div class="col-sm-4">
    	<div class="form-group">
          <?php echo $form->error($model,'Fecha_Factura', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Fecha_Factura'); ?>
          <?php echo $form->textField($model,'Fecha_Factura', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
    	</div>
  	</div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = Yii::app()->params->estados; ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'EquipoAntivirus[Estado]',
                    'id'=>'EquipoAntivirus_Estado',
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
<div class="row">
  	<div class="col-sm-8">
  		<div class="form-group">
  			<?php echo $form->error($model,'sop', array('class' => 'pull-right badge bg-red')); ?>
    		<div class="pull-right badge bg-red" id="error_sop" style="display: none;"></div>
    		<input type="hidden" id="valid_doc" value="1">
      		<?php echo $form->label($model,'sop'); ?>
		    <?php echo $form->fileField($model, 'sop'); ?>
        </div>
    </div>
</div>

<div class="btn-group" id="buttons">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipo/view&id='.$e; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-floppy-o"></i> <?php if($model->isNewRecord){echo 'Crear';}else{ echo 'Guardar';} ?></button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">


$(function() {

	var extensionesValidas = ".pdf, .JPEG, .JPG, .PNG, .jpeg, .jpg, .png";
	var pesoPermitido = 1024;

	$("#valida_form").click(function() {
      var form = $("#equipo-antivirus-form");
      var settings = form.data('settings') ;

      var soporte = $('#EquipoAntivirus_sop').val();

      settings.submitting = true ;
      $.fn.yiiactiveform.validate(form, function(messages) {
          if($.isEmptyObject(messages)) {
              $.each(settings.attributes, function () {
                 $.fn.yiiactiveform.updateInput(this,messages,form); 
              });
              	
              //se valida si el archivo cargado es valido (1)
              valid_doc = $('#valid_doc').val();

              if(valid_doc == 1){
              	//se envia el form
              	$('#buttons').hide();
              	form.submit();
              }else{

              	settings.submitting = false ;	
              }
              

          } else {
              settings = form.data('settings'),
              $.each(settings.attributes, function () {
                 $.fn.yiiactiveform.updateInput(this,messages,form); 
              });
              settings.submitting = false ;
          }
      });
  	});

  	$("#EquipoAntivirus_sop").change(function () {

  		$('#error_sop').html('');
    	$('#error_sop').hide();

  		if(validarExtension(this)) {

  	    	if(validarPeso(this)) {

  	    		$('#valid_doc').val(1);

  	    	}
  		}  
    });


	// Validacion de extensiones permitidas
	function validarExtension(datos) {

		var ruta = datos.value;
		var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
		var extensionValida = extensionesValidas.indexOf(extension);

		if(extensionValida < 0) {

		 	$('#error_sop').html('La extensión no es válida (.'+ extension+'), Solo se admite (.pdf, .png, .jpeg, .jpg)');
		 	$('#error_sop').show();
		 	$('#valid_doc').val(0);
		 	return false;

		} else {

			return true;

		}
	}

	// Validacion de peso del fichero en kbs

	function validarPeso(datos) {

		if (datos.files && datos.files[0]) {

	        var pesoFichero = datos.files[0].size/1024;

	        if(pesoFichero > pesoPermitido) {

	            $('#error_sop').html('El peso maximo permitido del fichero es: ' + pesoPermitido / 1024 + ' MB, Su fichero tiene: '+ (pesoFichero /1024).toFixed(2) +' MB.');
	            $('#error_sop').show();
	            $('#valid_doc').val(0);
	            return false;

	        } else {

	            return true;

	        }

	    }

	}

});

	
</script>