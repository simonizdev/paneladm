<?php
/* @var $this LicenciaController */
/* @var $model Licencia */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'licencia-form',
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
  	<div class="form-group">
  		<?php echo $form->error($model,'Clasificacion', array('class' => 'pull-right badge bg-red')); ?>
			<?php echo $form->label($model,'Clasificacion'); ?><br>
			<?php
			  $this->widget('ext.select2.ESelect2',array(
			      'name'=>'Licencia[Clasificacion]',
			      'id'=>'Licencia_Clasificacion',
	      		'data'=>$lista_clases,
			      'value' => $model->Clasificacion,
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
      <?php echo $form->error($model,'Tipo', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Tipo'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Licencia[Tipo]',
              'id'=>'Licencia_Tipo',
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
      <?php echo $form->error($model,'Version', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Version'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Licencia[Version]',
              'id'=>'Licencia_Version',
              'data'=>$lista_versiones,
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
      <?php echo $form->error($model,'Producto', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Producto'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Licencia[Producto]',
              'id'=>'Licencia_Producto',
              'data'=>$lista_productos,
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
  		<?php echo $form->error($model,'Id_Licencia', array('class' => 'pull-right badge bg-red')); ?>
  		<?php echo $form->label($model,'Id_Licencia'); ?>
  		<?php echo $form->textField($model,'Id_Licencia', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off')); ?>
  	</div>	
	</div>
	<div class="col-sm-4">
  	<div class="form-group">
  		<?php echo $form->error($model,'Num_Licencia', array('class' => 'pull-right badge bg-red')); ?>
  		<?php echo $form->label($model,'Num_Licencia'); ?>
  		<?php echo $form->textField($model,'Num_Licencia', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off')); ?>
  	</div>	
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
  	<div class="form-group">
  		<?php echo $form->error($model,'Token', array('class' => 'pull-right badge bg-red')); ?>
  		<?php echo $form->label($model,'Token'); ?>
  		<?php echo $form->textField($model,'Token', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off')); ?>
  	</div>	
	</div>
	<div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'Empresa_Compra', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Empresa_Compra'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Licencia[Empresa_Compra]',
              'id'=>'Licencia_Empresa_Compra',
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
              'name'=>'Licencia[Proveedor]',
              'id'=>'Licencia_Proveedor',
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
      <?php echo $form->textField($model,'Numero_Factura', array('class' => 'form-control', 'maxlength' => '50', 'autocomplete' => 'off')); ?>
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
  		<?php echo $form->error($model,'Valor_Comercial', array('class' => 'pull-right badge bg-red')); ?>
  		<?php echo $form->label($model,'Valor_Comercial'); ?>
  		<?php echo $form->numberField($model,'Valor_Comercial', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
  	</div>	
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
  	<div class="form-group">
      <?php echo $form->error($model,'Fecha_Inicio', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Fecha_Inicio'); ?>
      <?php echo $form->textField($model,'Fecha_Inicio', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
		</div>
	</div>
	<div class="col-sm-4">
  	<div class="form-group">
      <?php echo $form->error($model,'Fecha_Final', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Fecha_Final'); ?>
      <?php echo $form->textField($model,'Fecha_Final', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
  	</div>
	</div>
	<div class="col-sm-4">
  	<div class="form-group">
      <?php echo $form->error($model,'Fecha_Inicio_Sop', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Fecha_Inicio_Sop'); ?>
      <?php echo $form->textField($model,'Fecha_Inicio_Sop', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
  	</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
  	<div class="form-group">
      <?php echo $form->error($model,'Fecha_Final_Sop', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Fecha_Final_Sop'); ?>
      <?php echo $form->textField($model,'Fecha_Final_Sop', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
  	</div>
	</div>
	<div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'Numero_Inventario', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Numero_Inventario'); ?>
      <?php echo $form->textField($model,'Numero_Inventario', array('class' => 'form-control', 'maxlength' => '50', 'autocomplete' => 'off')); ?>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'Cuenta_Registro', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Cuenta_Registro'); ?>
      <?php echo $form->textField($model,'Cuenta_Registro', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off')); ?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'Link', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Link'); ?>
      <?php echo $form->textField($model,'Link', array('class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off')); ?>
    </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
          <?php echo $form->error($model,'Password', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'Password'); ?>
          <?php echo $form->textField($model,'Password', array('class' => 'form-control', 'maxlength' => '200', 'autocomplete' => 'off')); ?>
        </div>  
    </div>
    <div class="col-sm-4">
    	<div class="form-group">
    		<?php echo $form->error($model,'Cant_Usuarios', array('class' => 'pull-right badge bg-red')); ?>
      	<?php echo $form->label($model,'Cant_Usuarios'); ?>
		    <?php echo $form->numberField($model,'Cant_Usuarios', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number', 'min'=> 1, 'max'=>100)); ?>
      </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-4">
	  <div class="form-group">
	    <?php echo $form->error($model,'Ubicacion', array('class' => 'pull-right badge bg-red')); ?>
	    <?php echo $form->label($model,'Ubicacion'); ?>
	    <?php
        $this->widget('ext.select2.ESelect2',array(
            'name'=>'Licencia[Ubicacion]',
            'id'=>'Licencia_Ubicacion',
            'data'=>$lista_ubicaciones,
            'value' => $model->Ubicacion,
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
		 <?php echo $form->error($model,'Notas', array('class' => 'pull-right badge bg-red')); ?>
		 <?php echo $form->label($model,'Notas'); ?>
		 <?php echo $form->textArea($model,'Notas',array('class' => 'form-control', 'rows'=>6, 'cols'=>50, 'onkeyup' => 'convert_may(this)')); ?>
	  </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'Estado', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'Estado'); ?>
      <?php
        $this->widget('ext.select2.ESelect2',array(
            'name'=>'Licencia[Estado]',
            'id'=>'Licencia_Estado',
            'data'=>$lista_estados,
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=licencia/admin'; ?>';"><i class="fa fa-reply"></i> Volver</button>
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
      var form = $("#licencia-form");
      var settings = form.data('settings') ;

      var soporte = $('#Licencia_sop').val();

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
              settings.submitting = false ;
          }
      });
  	});

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

	$("#Licencia_Fecha_Inicio").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var minDate = new Date(selected.date.valueOf());
	   $('#Licencia_Fecha_Final').datepicker('setStartDate', minDate);
	});

	$("#Licencia_Fecha_Final").datepicker({
	  language: 'es',
	  autoclose: true,
	  orientation: "right bottom",
	}).on('changeDate', function (selected) {
	   var maxDate = new Date(selected.date.valueOf());
	   $('#Licencia_Fecha_Inicio').datepicker('setEndDate', maxDate);
	});

  	$("#Licencia_sop").change(function () {

  		$('#error_sop').html('');
    	$('#error_sop').hide();

  		if(validarExtension(this, 1)) {

  	    	if(validarPeso(this, 1)) {

  	    		$('#valid_doc').val(1);

  	    	}
  		}  
    });

    $("#Licencia_sop2").change(function () {

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