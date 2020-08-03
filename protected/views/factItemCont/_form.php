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

<div id="div_mensaje" style="display: none;"></div>

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
          <?php echo $form->hiddenField($model,'cad_item'); ?>
          <?php echo $form->hiddenField($model,'cad_cant'); ?>
          <?php echo $form->hiddenField($model,'cad_vlr_u'); ?>
          <?php echo $form->hiddenField($model,'cad_iva'); ?>         
        </div>
    </div>
    <div class="col-sm-4">
      	<div class="form-group">
          <div id="error_num_fact" class="pull-right badge bg-red" style="display: none;"></div>
          <?php echo $form->label($model,'Numero_Factura'); ?>
          <?php echo $form->textField($model,'Numero_Factura', array('class' => 'form-control', 'maxlength' => '50', 'autocomplete' => 'off', 'onkeyup' => 'convert_may(this)')); ?>
      	</div>
  	</div>
</div>
<div class="row">
	<div class="col-sm-4">
  	<div class="form-group">
      <div id="error_fec_fact" class="pull-right badge bg-red" style="display: none;"></div>
      <?php echo $form->label($model,'Fecha_Factura'); ?>
      <?php echo $form->textField($model,'Fecha_Factura', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
  	</div>
	</div>
  <div class="col-sm-4">
    <div class="form-group">
      <div id="error_tasa_cambio" class="pull-right badge bg-red" style="display: none;"></div>
      <?php echo $form->label($model,'Tasa_Cambio'); ?>
      <?php echo $form->numberField($model,'Tasa_Cambio', array('class' => 'form-control', 'autocomplete' => 'off', 'min' => '0', 'step' => '0.01')); ?>
    </div>
  </div>
  <div class="col-sm-4">
    <?php echo $form->label($model,'vlr_total'); ?>
    <?php echo '<p id="vlr_total">-</p>'; ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-8">
    <div class="form-group">
       <?php echo $form->error($model,'item', array('class' => 'pull-right badge bg-red')); ?>
       <?php echo $form->label($model,'item'); ?>
       <?php
        $this->widget('ext.select2.ESelect2',array(
            'name'=>'FactItemCont[item]',
            'id'=>'FactItemCont_item',
            'data'=>$lista_items,
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
</div>

<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success"  onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=cont/view&id='.$c; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="add" onclick="add_item();"><i class="fa fa-plus"></i> Agregar</button>
</div>

<div id="contenido"></div>

<div class="btn-group" id="btn_save" style="display: none;padding-bottom: 2%">
    <button type="button" class="btn btn-success" onclick="return valida_opciones(event);"><i class="fa fa-floppy-o"></i> Guardar</button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">


function add_item(){

  var id_contrato = $('#FactItemCont_Id_Contrato').val();
  var n_factura = $('#FactItemCont_Numero_Factura').val();
  var f_factura = $('#FactItemCont_Fecha_Factura').val();
  var tasa_cambio = $('#FactItemCont_Tasa_Cambio').val();
  var id_fact = 0;
  var item = $('#FactItemCont_item').val();

  if(n_factura != "" && f_factura != "" && item != "" && tasa_cambio != "" && tasa_cambio >= 0){

    limp_div_msg();

    var div_contenido = $('#contenido');
    var tr = $("#tr_"+item).length;

    if(!tr){

      var cant = $(".tr_items").length;

      if(cant == 0){
        div_contenido.append('<table class="table" id="table_item" style="font-size:11px !important;"><thead><tr><th>Item</th><th>Cant.</th><th>Vlr. unit.</th><th>Moneda</th><th>Iva</th><th>Vlr. total</th></tr></thead><tbody></tbody></table>');
      }

      $('#btn_save').show();

      var data = {item: item}
      $.ajax({ 
        type: "POST", 
        url: "<?php echo Yii::app()->createUrl('factItemCont/infoitem'); ?>",
        data: data,
        dataType: 'json',
        success: function(response){

          var i = response.item;
          var desc_item = response.desc_item;
          var cant = response.cant;
          var vlr_unit = response.vlr_unit;
          var iva = response.iva;
          var id_moneda = response.id_moneda;
          var moneda = response.moneda;

          if(id_moneda == <?php echo Yii::app()->params->moneda_USD ?>){

            if(iva == 0){

              var vlr_total = (vlr_unit * tasa_cambio) * cant;

            }else{

              var vlr_base = (vlr_unit * tasa_cambio) * cant;
              var vlr_iva = ((vlr_base * iva) / 100);
              var vlr_total = vlr_base + vlr_iva;

            }

          }else{

            if(iva == 0){

              var vlr_total = vlr_unit * cant;

            }else{

              var vlr_base = vlr_unit * cant;
              var vlr_iva = ((vlr_base * iva) / 100);
              var vlr_total = vlr_base + vlr_iva;

            }

          }

          var tabla = $('#table_item');

          tabla.append('<tr class="tr_items" id="tr_'+i+'"><td><input type="hidden" class="items" value="'+i+'">'+desc_item+'</td><td><input type="number" id="cant_'+i+'" value="'+cant+'" onchange="cal_total_x_item('+i+');"></td><td><input type="number" id="vu_'+i+'" value="'+vlr_unit+'" onchange="cal_total_x_item('+i+');"></td><td><input type="hidden" id="moneda_'+i+'" value="'+id_moneda+'">'+moneda+'</td><td><input type="number" id="iva_'+i+'" value="'+iva+'" onchange="cal_total_x_item('+i+');"></td><td><input type="number" id="vt_'+i+'" value="'+vlr_total+'" disabled></td><td><button type="button" class="btn btn-danger btn-xs delete"><i class="fa fa-trash" aria-hidden="true"></i> </button></td></tr>');

          cal_total_fact();
        }
      });

      $('#FactItemCont_item').val('').trigger('change');

    }else{
      $("#div_mensaje").addClass("alert alert-warning alert-dismissible");
      $("#div_mensaje").html('<button type="button" class="close" aria-hidden="true" onclick="limp_div_msg();">×</button><h4><i class="icon fa fa-info-circle"></i>Cuidado</h4><p>Este item ya esta asociado a la factura.</p>');
        $("#div_mensaje").show();
    }

  }else{

    if(n_factura == ""){
      $('#error_num_fact').html('N° de fact. no puede ser nulo.');
      $('#error_num_fact').show(); 
    }

    if(f_factura == ""){
      $('#error_fec_fact').html('Fecha de fact. no puede ser nulo.');
      $('#error_fec_fact').show();    
    }

    if(tasa_cambio == ""){
      $('#error_tasa_cambio').html('Tasa de cambio no puede ser nulo.');
      $('#error_tasa_cambio').show();    
    }

    if(item == ""){
      $('#FactItemCont_item_em_').html('Item no puede ser nulo.');
      $('#FactItemCont_item_em_').show();    
    }
  }
}

$("body").on("click", ".delete", function (e) {
    
  $(this).parent().parent("tr").remove();
  var cant = $(".tr_items").length;
  
  if(cant == 0){
      $('#contenido').html('');
      $('#btn_save').hide();  
  }else{
      $('#btn_save').show();  
  }

  cal_total_fact();

});

$("#FactItemCont_Numero_Factura").change(function() {
  var val = $("#FactItemCont_Numero_Factura").val();
  if(val == ""){
    limp_div_msg();
    $('#error_num_fact').html('N° de fact. no puede ser nulo.');
    $('#error_num_fact').show();
    $('#btn_save').hide(); 
  }else{

    $('#error_num_fact').html('');
    $('#error_num_fact').hide();

    var cant = $(".tr_items").length;
  
    if(cant > 0){
      $('#btn_save').show();  
    } 
  }

});

$("#FactItemCont_Fecha_Factura").change(function() {
  var val = $("#FactItemCont_Fecha_Factura").val();
  if(val == ""){
    limp_div_msg();
    $('#error_fec_fact').html('Fecha de fact. no puede ser nulo.');
    $('#error_fec_fact').show();
    $('#btn_save').hide(); 
  }else{

    $('#error_fec_fact').html('');
    $('#error_fec_fact').hide();

    var cant = $(".tr_items").length;
  
    if(cant > 0){
      $('#btn_save').show();  
    } 
  }

});

$("#FactItemCont_Tasa_Cambio").change(function() {
  var val = $("#FactItemCont_Tasa_Cambio").val();
  if(val == ""){
    $('#error_tasa_cambio').html('Tasa de cambio no puede ser nulo.');
    $('#error_tasa_cambio').show();

    $("input.items").each(function() {
      var item = $(this).val();
      $("#vt_"+item).val('');
    });

    $("#vlr_total").html('-');
    $('#btn_save').hide(); 
  }else{

    if(val >= 0){
      $('#error_tasa_cambio').html('');
      $('#error_tasa_cambio').hide();

      var cant = $(".tr_items").length;
    
      if(cant > 0){
        
        $("input.items").each(function() {
          var item = $(this).val();
          cal_total_x_item(item)
        });

        $('#btn_save').show();  
      } 
    }else{
      $('#error_tasa_cambio').html('Tasa de cambio debe ser igual o mayor a 0.');
      $('#error_tasa_cambio').show();

      $("input.items").each(function() {
        var item = $(this).val();
        $("#vt_"+item).val('');
      });

      $("#vlr_total").html('-');
      $('#btn_save').hide(); 
    }

    
  }

});


function limp_div_msg(){
  $("#div_mensaje").hide();  
  classact = $('#div_mensaje').attr('class');
  $("#div_mensaje").removeClass(classact);
  $("#mensaje").html('');
}

function cal_total_fact(){
  debugger;
  $(".ajax-loader").fadeIn('fast');

  var vlr_total = 0;
  
  $("input.items").each(function() {

    var item = $(this).val();
    var vlr_t = parseFloat($('#vt_'+item).val());
    vlr_total += vlr_t.round(2);

  });

   

  $("#vlr_total").html(formatNumber(vlr_total)+' COP');
  $(".ajax-loader").fadeOut('fast'); 
}

function cal_total_x_item(item){

  $(".ajax-loader").fadeIn('fast');
  
  var cant = $("#cant_"+item).val();
  var vlr_unit = $("#vu_"+item).val();
  var iva = $("#iva_"+item).val();
  var id_moneda = $("#moneda_"+item).val();
  var tasa_cambio = $("#FactItemCont_Tasa_Cambio").val();
  

  if(cant != "" && vlr_unit != "" && iva != "" && tasa_cambio != ""){
    
    if(cant > 0 && vlr_unit > 0 && vlr_unit > 0 && iva >= 0 && tasa_cambio >= 0){
      if(id_moneda == <?php echo Yii::app()->params->moneda_USD ?>){

        if(iva == 0){

          var vlr_total = (vlr_unit * tasa_cambio) * cant;

        }else{

          var vlr_base = (vlr_unit * tasa_cambio) * cant;
          var vlr_iva = ((vlr_base * iva) / 100);
          var vlr_total = vlr_base + vlr_iva;

        }

      }else{

        if(iva == 0){

          var vlr_total = vlr_unit * cant;

        }else{

          var vlr_base = vlr_unit * cant;
          var vlr_iva = ((vlr_base * iva) / 100);
          var vlr_total = vlr_base + vlr_iva;

        }

      }

      $("#vt_"+item).val(vlr_total);
      $('#btn_save').show();

      cal_total_fact();
      limp_div_msg();

    }else{

      $("#div_mensaje").addClass("alert alert-warning alert-dismissible");
      $("#div_mensaje").html('<button type="button" class="close" aria-hidden="true" onclick="limp_div_msg();">×</button><h4><i class="icon fa fa-info-circle"></i>Cuidado</h4><p>Hay item(s) configurados con valores invalidos y/o vacios.</p>');
      $("#div_mensaje").show();
 
      $("#vt_"+item).val('');
      $("#vlr_total").html('-');
      $('#btn_save').hide();  
    }

  }else{

    $("#div_mensaje").addClass("alert alert-warning alert-dismissible");
    $("#div_mensaje").html('<button type="button" class="close" aria-hidden="true" onclick="limp_div_msg();">×</button><h4><i class="icon fa fa-info-circle"></i>Cuidado</h4><p>Hay item(s) configurados con valores invalidos y/o vacios.</p>');
    $("#div_mensaje").show();

    $("#vt_"+item).val('');
    $("#vlr_total").html('-');
    $('#btn_save').hide(); 
  }

  $(".ajax-loader").fadeOut('fast');

}

function valida_opciones(){

  var id_contrato = $('#FactItemCont_Id_Contrato').val();
  var n_factura = $('#FactItemCont_Numero_Factura').val();
  var f_factura = $('#FactItemCont_Fecha_Factura').val();
  var id_fact = 0;

  if(n_factura != "" && f_factura != ""){

    var data = {id_contrato: id_contrato, n_factura: n_factura, id_fact: 0}
    $.ajax({ 
      type: "POST", 
      url: "<?php echo Yii::app()->createUrl('factItemCont/existfact'); ?>",
      data: data,
      success: function(response){

        if(response == 1){

            $('#btn_save').hide();
            limp_div_msg();
            $(".ajax-loader").fadeIn('fast');
  
            $('#FactItemCont_cad_item').val('');
            $('#FactItemCont_cad_cant').val('');
            $('#FactItemCont_cad_vlr_u').val('');
            $('#FactItemCont_cad_iva').val('');
                
            var item_selected = ''; 
            var cant_selected = '';
            var vlr_u_selected = '';
            var iva_selected = '';

            $("input.items").each(function() {

              var item = $(this).val();
              var cant = $('#cant_'+item).val();
              var vlr_u = parseInt($('#vu_'+item).val());
              var iva = parseInt($('#iva_'+item).val());
             
              item_selected += item+','; 
              cant_selected += cant+','; 
              vlr_u_selected += vlr_u+',';  
              iva_selected += iva+','; 
              
            });

            var cadena_item = item_selected.slice(0,-1);
            var cadena_cant = cant_selected.slice(0,-1);
            var cadena_vlr_u = vlr_u_selected.slice(0,-1);
            var cadena_iva = iva_selected.slice(0,-1);
            
            $('#FactItemCont_cad_item').val(cadena_item);
            $('#FactItemCont_cad_cant').val(cadena_cant);
            $('#FactItemCont_cad_vlr_u').val(cadena_vlr_u);
            $('#FactItemCont_cad_iva').val(cadena_iva);

            var form = $("#fact-item-cont-form");
            form.submit();
               
        }else{

          $("#div_mensaje").addClass("alert alert-warning alert-dismissible");
          $("#div_mensaje").html('<button type="button" class="close" aria-hidden="true" onclick="limp_div_msg();">×</button><h4><i class="icon fa fa-info-circle"></i>Cuidado</h4><p>Esta factura ya se encuentra asociada al contrato.</p>');
          $("#div_mensaje").show();
        }
      }
    });
  }

}

function formatNumber(num) {
  return num;
  //.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

	
</script>