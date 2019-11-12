<?php
/* @var $this EquipoSoController */
/* @var $model EquipoSo */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipo-so-form',
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
                    'name'=>'EquipoSo[Tipo_Licencia]',
                    'id'=>'EquipoSo_Tipo_Licencia',
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
                    'name'=>'EquipoSo[Version]',
                    'id'=>'EquipoSo_Version',
                    'data'=>$versiones_so,
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
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = Yii::app()->params->estados; ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'EquipoSo[Estado]',
                    'id'=>'EquipoSo_Estado',
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
    		<input type="hidden" id="valid_doc" value="0">
    		<?php echo $form->label($model,'sop'); ?>
		    <?php echo $form->fileField($model, 'sop'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
      <div class="form-group">
        <?php echo $form->error($model,'sop2', array('class' => 'pull-right badge bg-red')); ?>
        <div class="pull-right badge bg-red" id="error_sop2" style="display: none;"></div>
        <input type="hidden" id="valid_doc2" value="1">
        <?php echo $form->label($model,'sop2'); ?>
        <?php echo $form->fileField($model, 'sop2'); ?>
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

  var extensionesValidas2 = ".JPEG, .JPG, .PNG, .jpeg, .jpg, .png";
  var pesoPermitido2 = 512;

	$("#valida_form").click(function() {
      var form = $("#equipo-so-form");
      var settings = form.data('settings') ;

      var soporte = $('#EquipoSo_sop').val();

      if(soporte == ''){
      	$('#error_sop').html('Soporte no puede ser nulo');
      	$('#error_sop').show(); 
      }

      settings.submitting = true ;
      $.fn.yiiactiveform.validate(form, function(messages) {
          if($.isEmptyObject(messages)) {
              $.each(settings.attributes, function () {
                 $.fn.yiiactiveform.updateInput(this,messages,form); 
              });
              	
              //se valida si el archivo cargado es valido (1)
              valid_doc = $('#valid_doc').val();
              valid_doc2 = $('#valid_doc2').val();

              if(valid_doc == 1 && valid_doc2 == 1){
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
              settings.submitting = false;
          }
      });
  	});

  	$("#EquipoSo_sop").change(function () {

  		$('#error_sop').html('');
    	$('#error_sop').hide();

  		if(validarExtension(this, 1)) {

  	    	if(validarPeso(this, 1)) {

  	    		$('#valid_doc').val(1);

  	    	}
  		}  
    });

    $("#EquipoSo_sop2").change(function () {

      $('#error_sop2').html('');
      $('#error_sop2').hide();

      if(validarExtension(this, 2)) {

          if(validarPeso(this, 2)) {

            $('#valid_doc2').val(1);

          }
      }  
    });

	// Validacion de extensiones permitidas
	function validarExtension(datos, opc) {

    if(opc == 1){
      //soporte 1

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

    if(opc == 2){
      //soporte 2

      var ruta = datos.value;
      var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
      var extensionValida = extensionesValidas2.indexOf(extension);

      if(extensionValida < 0) {

        $('#error_sop2').html('La extensión no es válida (.'+ extension+'), Solo se admite (.png, .jpeg, .jpg)');
        $('#error_sop2').show();
        $('#valid_doc2').val(0);
        return false;

      } else {

        return true;

      }
    }

	}

	// Validacion de peso del fichero en kbs

	function validarPeso(datos, opc) {

		if (datos.files && datos.files[0]) {

      if(opc == 1){
      //soporte 1  

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

      if(opc == 2){
      //soporte 2   

        var pesoFichero = datos.files[0].size/1024;

        if(pesoFichero > pesoPermitido2) {

            $('#error_sop2').html('El peso maximo permitido del fichero es: ' + pesoPermitido2 / 1024 + ' MB, Su fichero tiene: '+ (pesoFichero /1024).toFixed(2) +' MB.');
            $('#error_sop2').show();
            $('#valid_doc2').val(0);
            return false;

        } else {

            return true;

        }

      }

    }

	}

});

	
</script>