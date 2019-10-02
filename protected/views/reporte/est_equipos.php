<?php
/* @var $this ReporteController */
/* @var $model Reporte */

//para combos de tipos de equipo
$lista_tipos_equipo = CHtml::listData($tipos_equipo, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

?>

<h3>Estadística de equipos</h3>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reporte-form',
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
      <?php echo $form->error($model,'empresa_compra', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'empresa_compra'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Reporte[empresa_compra]',
              'id'=>'Reporte_empresa_compra',
              'data'=>$lista_empresas,
              'htmlOptions'=>array(
                'multiple'=>'multiple',
              ),
              'options'=>array(
                  'placeholder'=>'TODAS',
                  'width'=> '100%',
                  'allowClear'=>true,
              ),
          ));
      ?>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'tipo_equipo', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'tipo_equipo'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Reporte[tipo_equipo]',
              'id'=>'Reporte_tipo_equipo',
              'data'=>$lista_tipos_equipo,
              'htmlOptions'=>array(
                'multiple'=>'multiple',
              ),
              'options'=>array(
                  'placeholder'=>'TODOS',
                  'width'=> '100%',
                  'allowClear'=>true,
              ),
          ));
      ?>
    </div>
  </div>             
  <div class="col-sm-4">
  	<div class="form-group">
		  <?php echo $form->error($model,'opcion_exp', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'opcion_exp'); ?><br>
		  <?php 
			    echo $form->radioButtonList($model,'opcion_exp',
		    	array('3'=>'<i class="fa fa-desktop" aria-hidden="true"></i> Pantalla','2'=>'<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL'),
		    	array(
		        	'template'=>'{input}{label}',
		        	'separator'=>'',
		        	'labelOptions'=>array(
		            	'style'=> '
		                	padding-left:1%;
		                	padding-right:5%;
	            	'),
	          	)                              
	      	);
		  ?>			
  	</div>
  </div>
</div>

<div class="btn-group" style="padding-bottom: 2%">
  <button type="button" class="btn btn-success" onclick="resetfields();"><i class="fa fa-eraser"></i> Limpiar filtros </button>
  <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-bar-chart"></i> Generar </button>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12 table-responsive" id="resultados" style="font-size: 10px !important;">
    <!-- contenido via ajax -->
    </div>
</div>  


<?php $this->endWidget(); ?>

<script>

$(function() {

  $("#valida_form").click(function() {

      var form = $("#reporte-form");
      var settings = form.data('settings') ;
      settings.submitting = true ;
      $.fn.yiiactiveform.validate(form, function(messages) {
          if($.isEmptyObject(messages)) {
              $.each(settings.attributes, function () {
                 $.fn.yiiactiveform.updateInput(this,messages,form); 
              });
              $("#resultados").html(''); 
              //se envia el form
              if($("input:radio:checked").val() == 3){
                reporte_pantalla();
              }else{
                form.submit();
                $(".ajax-loader").show('fast');
                setTimeout(function(){ $(".ajax-loader").hide('fast'); }, 5000); 
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
});

function reporte_pantalla(){

  var cad_empresas = "";

  $('#Reporte_empresa_compra :selected').each(function(i, sel){ 
      cad_empresas += $(sel).val()+','; 
  });

  if(cad_empresas != ""){
    var empresa_compra = cad_empresas.slice(0,-1);
  }else{
    var empresa_compra = "";  
  }

  var cad_tipos_equipo = "";

  $('#Reporte_tipo_equipo :selected').each(function(i, sel){ 
      cad_tipos_equipo += $(sel).val()+','; 
  });

  if(cad_tipos_equipo != ""){
    var tipo_equipo = cad_tipos_equipo.slice(0,-1);
  }else{
    var tipo_equipo = "";  
  }

  var data = {
    empresa_compra: empresa_compra, 
    tipo_equipo: tipo_equipo
  }
  
  $(".ajax-loader").show('fast');
  $.ajax({ 
    type: "POST", 
    url: "<?php echo Yii::app()->createUrl('reporte/estequipospant'); ?>",
    data: data,
    success: function(data){ 
      $(".ajax-loader").hide('fast');
      $("#resultados").html(data); 
    }
  });

}

function resetfields(){

  $('#Reporte_empresa_compra').val('').trigger('change');
  $('#Reporte_tipo_equipo').val('').trigger('change');
  $("#resultados").html(''); 

}
  
</script>


