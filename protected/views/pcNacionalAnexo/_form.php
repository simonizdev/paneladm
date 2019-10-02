<?php
/* @var $this PcNacionalAnexoController */
/* @var $model PcNacionalAnexo */
/* @var $form CActiveForm */

if($tipo == Yii::app()->params->pc_comercial){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacionalAnexo/adminCom';
}

if($tipo == Yii::app()->params->pc_administrativo){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacionalAnexo/adminAdm';
}

if($tipo == Yii::app()->params->pc_fiscal){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacionalAnexo/adminFis';
}

if($tipo == Yii::app()->params->pc_regulatorio){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacionalAnexo/adminReg';
}

if($tipo == Yii::app()->params->pc_laboral){
    $url = Yii::app()->getBaseUrl(true).'/index.php?r=pcNacionalAnexo/adminLab';
}

?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pc-nacional-anexo-form',
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
 	  <div class="col-sm-8">
        <div class="form-group">
          <?php echo $form->error($model,'Id_Pc_Nacional', array('class' => 'pull-right badge bg-red')); ?>
    		  <?php echo $form->label($model,'Id_Pc_Nacional'); ?>
          <?php echo $form->textField($model,'Id_Pc_Nacional'); ?>  
          <?php
            $this->widget('ext.select2.ESelect2', array(
                'selector' => '#PcNacionalAnexo_Id_Pc_Nacional',
                'options'  => array(
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'width' => '100%',
                    'language' => 'es',
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('PcNacionalAnexo/SearchPcNacional'),
                        'dataType'=>'json',
                        'data'=>'js:function(term){return{tipo: '.$tipo.', q: term};}',
                        'results'=>'js:function(data){ return {results:data};}'                   
                    ),
                    'formatNoMatches'=> 'js:function(){ clear_select2_ajax("PcNacionalAnexo_Id_Pc_Nacional"); return "No se encontraron resultados"; }',
                    'formatInputTooShort' =>  'js:function(){ return "Digite más de 3 caracteres para iniciar busqueda <button type=\"button\" class=\"btn btn-success btn-xs pull-right\" onclick=\"clear_select2_ajax(\'PcNacionalAnexo_Id_Pc_Nacional\')\">Limpiar campo</button>"; }',
                ),
            ));
          ?>        
        </div>
    </div>
  	<div class="col-sm-4">
      	<div class="form-group">
      		<?php echo $form->error($model,'Titulo', array('class' => 'pull-right badge bg-red')); ?>
      		<?php echo $form->label($model,'Titulo'); ?>
      		<?php echo $form->textField($model,'Titulo', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
</div>
<div class="row">
	  <div class="col-sm-4">
    	<div class="form-group">
            <?php echo $form->error($model,'Descripcion', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Descripcion'); ?>
            <?php echo $form->textArea($model,'Descripcion',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
    	</div>
  	</div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
            <?php echo $form->label($model,'Estado'); ?>
            <?php $estados = Yii::app()->params->estados; ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcNacionalAnexo[Estado]',
                    'id'=>'PcNacionalAnexo_Estado',
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
  			<?php echo $form->error($model,'doc', array('class' => 'pull-right badge bg-red')); ?>
    		<div class="pull-right badge bg-red" id="error_sop" style="display: none;"></div>
    		<input type="hidden" id="valid_doc" value="0">
      		<?php echo $form->label($model,'doc'); ?>
		    <?php echo $form->fileField($model, 'doc'); ?>
        </div>
    </div>
</div>


<div class="btn-group" id="buttons">
    <button type="button" class="btn btn-success"  onclick="location.href = '<?php echo $url; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-floppy-o"></i> <?php if($model->isNewRecord){echo 'Crear';}else{ echo 'Guardar';} ?></button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">


$(function() {

	var extensionesValidas = ".pdf";
	var pesoPermitido = 5120;

	$("#valida_form").click(function() {
      var form = $("#pc-nacional-anexo-form");
      var settings = form.data('settings') ;

      var soporte = $('#PcNacionalAnexo_doc').val();

      if(soporte == ''){
      	$('#error_sop').html('Documento no puede ser nulo');
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

  	$("#PcNacionalAnexo_doc").change(function () {

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

		 	$('#error_sop').html('La extensión no es válida (.'+ extension+'), Solo se admite (.pdf)');
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

	            $('#error_sop').html('El peso maximo permitido del fichero es: ' + pesoPermitido / 1024 + ' MB,Su fichero tiene: '+ (pesoFichero /1024).toFixed(2) +' MB.');
	            $('#error_sop').show();
	            $('#valid_doc').val(0);
	            return false;

	        } else {

	            return true;

	        }

	    }

	}

});

function clear_select2_ajax(id){
  $('#'+id+'').val('').trigger('change');
  $('#s2id_'+id+' span').html("");
}
	
</script>