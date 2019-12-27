<?php
/* @var $this ReporteController */
/* @var $model Reporte */


//para combos de tipos de equipo
//$lista_tipos_equipo = CHtml::listData($tipos_equipo, 'Id_Dominio', 'Dominio');

//para combos clases de licencia
$lista_clases_licencia = CHtml::listData($clases_licencias, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

?>

<h3>Soporte(s) de licencia(s)</h3>

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

<div id="div_mensaje" style="display: none;"></div>

<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <?php echo $form->error($model,'opc', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'opc'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Reporte[opc]',
              'id'=>'Reporte_opc',
              'data'=> array(1 => 'INDIVIDUAL' , 2 => 'GRUPO'),
              'htmlOptions'=>array(
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
  <div class="col-sm-8" id="div_equipo" style="display: none;">
    <div class="form-group">
          <?php echo $form->error($model,'equipo', array('class' => 'pull-right badge bg-red')); ?>
          <?php echo $form->label($model,'equipo'); ?>

          <?php echo $form->textField($model,'equipo'); ?>
          <?php
              $this->widget('ext.select2.ESelect2', array(
                  'selector' => '#Reporte_equipo',
                  'options'  => array(
                      'allowClear' => true,
                      'minimumInputLength' => 3,
                      'width' => '100%',
                      'language' => 'es',
                      'ajax' => array(
                          'url' => Yii::app()->createUrl('reporte/SearchEquipo'),
                          'dataType'=>'json',
                          'data'=>'js:function(term){return{q: term};}',
                          'results'=>'js:function(data){ return {results:data};}'                   
                      ),
                      'formatNoMatches'=> 'js:function(){ clear_select2_ajax("Reporte_equipo"); return "No se encontraron resultados"; }',
                      'formatInputTooShort' =>  'js:function(){ return "Digite más de 3 caracteres para iniciar busqueda <button type=\"button\" class=\"btn btn-success btn-xs pull-right\" onclick=\"clear_select2_ajax(\'Reporte_equipo\')\">Limpiar campo</button>"; }',
                  ),
              ));
          ?>
      </div>
  </div>
  <div class="col-sm-4" id="div_f_i" style="display: none;">
    <div class="form-group">
      <?php echo $form->error($model,'fecha_compra_inicial', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'fecha_compra_inicial'); ?>
      <?php echo $form->textField($model,'fecha_compra_inicial', array('class' => 'form-control', 'readonly' => true)); ?>
    </div>
  </div>
  <div class="col-sm-4" id="div_f_f" style="display: none;">
    <div class="form-group">
      <?php echo $form->error($model,'fecha_compra_final', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'fecha_compra_final'); ?>
      <?php echo $form->textField($model,'fecha_compra_final', array('class' => 'form-control', 'readonly' => true)); ?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4" id="div_empresa" style="display: none;">
    <div class="form-group">
      <?php echo $form->error($model,'empresa_compra', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'empresa_compra'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Reporte[empresa_compra]',
              'id'=>'Reporte_empresa_compra',
              'data'=>$lista_empresas,
              'htmlOptions'=>array(
                //'multiple'=>'multiple',
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
  <div class="col-sm-8" id="div_inc_lic" style="display: none;">
  	<div class="form-group">
      <?php echo $form->error($model,'inc_lic', array('class' => 'pull-right badge bg-red')); ?>
      <?php echo $form->label($model,'inc_lic'); ?>
      <?php
          $this->widget('ext.select2.ESelect2',array(
              'name'=>'Reporte[inc_lic]',
              'id'=>'Reporte_inc_lic',
              'data'=>$lista_clases_licencia,
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

<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success" onclick="resetfields();"><i class="fa fa-eraser"></i> Limpiar filtros </button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-file-archive-o"></i> Generar </button>
</div>
<!-- /.row -->

<?php $this->endWidget(); ?>

<script>

$(function() {

  $('#Reporte_opc').change(function(){
    
    opc = this.value;
    
    //Se limpia todo

    $('#div_equipo').hide();
    $('#Reporte_equipo').val('').trigger('change');
    $('#s2id_Reporte_equipo span').html("");
    
    $('#Reporte_equipo_em_').html('');
    $('#Reporte_equipo_em_').hide();
    
    $('#div_f_i').hide();
    $("#Reporte_fecha_compra_inicial").val(); 
    
    $('#div_f_f').hide();
    $("#Reporte_fecha_compra_final").val();
    
    $('#div_empresa').hide();
    $('#Reporte_empresa_compra_em_').html('');
    $('#Reporte_empresa_compra_em_').hide();
    $('#Reporte_empresa_compra').val('').trigger('change');
    
    $('#div_inc_lic').hide();
    $('#Reporte_inc_lic').val('').trigger('change');

    if(opc != ""){
      if(opc == 1){
        //individual
        $('#div_equipo').show();
        $('#div_inc_lic').show();
      }else{
        //grupal
        $('#div_f_i').show();
        $('#div_f_f').show();
        $('#div_empresa').show();
        $('#div_inc_lic').show();
      }
    }
    
  });

  $('#Reporte_equipo').change(function(){
    if(this.value != ""){
      $('#Reporte_equipo_em_').html('');
      $('#Reporte_equipo_em_').hide(); 
    }
  });

  $('#Reporte_empresa_compra').change(function(){
    if(this.value != ""){
      $('#Reporte_empresa_compra_em_').html('');
      $('#Reporte_empresa_compra_em_').hide(); 
    }
  });

  $('#Reporte_inc_lic').change(function(){
    if(this.value != ""){
      $('#Reporte_inc_lic_em_').html('');
      $('#Reporte_inc_lic_em_').hide(); 
    }
  });

  $("#valida_form").click(function() {

      var form = $("#reporte-form");
      var settings = form.data('settings') ;
      settings.submitting = true ;
      $.fn.yiiactiveform.validate(form, function(messages) {
        if($.isEmptyObject(messages)) {
          $.each(settings.attributes, function () {
             $.fn.yiiactiveform.updateInput(this,messages,form); 
          });

          var opc = $('#Reporte_opc').val();
          var serial = $('#Reporte_equipo').val();
          var fecha_compra_inicial = $('#Reporte_fecha_compra_inicial').val();
          var fecha_compra_final = $('#Reporte_fecha_compra_final').val();
          var empresa_compra = $('#Reporte_empresa_compra').val();
          var inc_lic = $('#Reporte_inc_lic').val();

          var cad_inc_lic = "";

          $('#Reporte_inc_lic :selected').each(function(i, sel){ 
              cad_inc_lic += $(sel).val()+','; 
          });

          var inc_lic = cad_inc_lic.slice(0,-1);

          if(opc == 1){
            //individual
            if(serial == "" ||  inc_lic == ""){

              if(serial == ""){
                $('#Reporte_equipo_em_').html('Serial no puede ser nulo.');
                $('#Reporte_equipo_em_').show(); 
              }

              if(inc_lic == ""){
                $('#Reporte_inc_lic_em_').html('Incluir licencia(s) no puede ser nulo.');
                $('#Reporte_inc_lic_em_').show(); 
              }

              $valid = 0;

            }else{
              $('#Reporte_equipo_em_').html('');
              $('#Reporte_equipo_em_').hide();

              $('#Reporte_inc_lic_em_').html('');
              $('#Reporte_inc_lic_em_').hide();

              var cad_inc_lic = "";

              $('#Reporte_inc_lic :selected').each(function(i, sel){ 
                  cad_inc_lic += $(sel).val()+','; 
              });

              var inc_lic = cad_inc_lic.slice(0,-1);

              $valid = 1;
            }
          }else{
            //grupo
            if(empresa_compra == "" ||  inc_lic == ""){
              
              if(empresa_compra == ""){
                $('#Reporte_empresa_compra_em_').html('Empresa no puede ser nulo.');
                $('#Reporte_empresa_compra_em_').show();
              }


              if(inc_lic == ""){
                $('#Reporte_inc_lic_em_').html('Incluir licencia(s) no puede ser nulo.');
                $('#Reporte_inc_lic_em_').show(); 
              }

              $valid = 0;

            }else{
              $('#Reporte_empresa_compra_em_').html('');
              $('#Reporte_empresa_compra_em_').hide();

              $('#Reporte_inc_lic_em_').html('');
              $('#Reporte_inc_lic_em_').hide();

              var cad_inc_lic = "";

              $('#Reporte_inc_lic :selected').each(function(i, sel){ 
                  cad_inc_lic += $(sel).val()+','; 
              });

              var inc_lic = cad_inc_lic.slice(0,-1);

              $valid = 1;
            }
          }

          if($valid == 1){
            var data = {
              opc: opc, 
              serial: serial, 
              fecha_compra_inicial: fecha_compra_inicial,
              fecha_compra_final: fecha_compra_final,
              empresa_compra: empresa_compra,
              inc_lic: inc_lic
            }
            
            $.ajax({ 
              type: "POST", 
              url: "<?php echo Yii::app()->createUrl('reporte/soportesl'); ?>",
              data: data,
              dataType: "json",
              beforeSend: function(){
                $(".ajax-loader").fadeIn('fast'); 
              },
              success: function(data){

                var resp = data.resp; 
                var mensaje = data.msg;
                var ruta = data.ruta;  
                var archivo = data.archivo;

                if(resp == 0){
                  $("#div_mensaje").addClass("alert alert-warning alert-dismissible");
                  $("#div_mensaje").html('<button type="button" class="close" aria-hidden="true" onclick="limp_div_msg();">×</button><h4><i class="icon fa fa-info-circle"></i>Cuidado</h4><p>'+mensaje+'</p>');

                  $("#div_mensaje").fadeIn('fast');
                  $(".ajax-loader").hide('fast');
                }

                if(resp == 1){
                  $("#div_mensaje").addClass("alert alert-success alert-dismissible");
                  $("#div_mensaje").html('<button type="button" class="close" aria-hidden="true" onclick="limp_div_msg();">×</button><h4><i class="icon fa fa-check"></i>Realizado</h4><p>'+mensaje+'</p>'); 
                  var link = document.createElement("a");
                  link.download = archivo;
                  link.href = ruta;
                  link.click(); 

                  $("#div_mensaje").fadeIn('fast');
                  $(".ajax-loader").hide('fast');
                }                 
              }
            });
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

  $("#Reporte_fecha_compra_inicial").datepicker({
      language: 'es',
      autoclose: true,
      orientation: "right bottom",
  }).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('#Reporte_fecha_compra_final').datepicker('setStartDate', minDate);
  });

  $("#Reporte_fecha_compra_final").datepicker({
      language: 'es',
      autoclose: true,
      orientation: "right bottom",
  }).on('changeDate', function (selected) {
    var maxDate = new Date(selected.date.valueOf());
    $('#Reporte_fecha_compra_inicial').datepicker('setEndDate', maxDate);
  });

});

function resetfields(){
  $('#Reporte_opc').val('').trigger('change');
}

function clear_select2_ajax(id){
  $('#'+id+'').val('').trigger('change');
  $('#s2id_'+id+' span').html("");
}

//función para limpiar el mensaje retornado por el ajax
function limp_div_msg(){
  $("#div_mensaje").hide();  
  classact = $('#div_mensaje').attr('class');
  $("#div_mensaje").removeClass(classact);
  $("#mensaje").html('');
}
  
</script>





