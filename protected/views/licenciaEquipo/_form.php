<?php
/* @var $this LicenciaEquipoController */
/* @var $model LicenciaEquipo */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'licencia-equipo-form',
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
    	<?php echo $form->label($model,'Id_Equipo'); ?>
        <?php echo '<p>'.UtilidadesVarias::descequipo($e).'</p>'; ?>     
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        	<?php echo $form->error($model,'Id_Licencia', array('class' => 'pull-right badge bg-red')); ?>
    		<?php echo $form->label($model,'Id_Licencia'); ?>
            <?php echo $form->textField($model,'Id_Licencia'); ?>
            <?php
                $this->widget('ext.select2.ESelect2', array(
                    'selector' => '#LicenciaEquipo_Id_Licencia',
                    'options'  => array(
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'width' => '100%',
                        'language' => 'es',
                        'ajax' => array(
                            'url' => Yii::app()->createUrl('licenciaequipo/SearchLicenciaAsocEquipo'),
                            'dataType'=>'json',
                            'data'=>'js:function(term){return{q: term, e: '.$e.'};}',
                            'results'=>'js:function(data){ return {results:data};}'                   
                        ),
                        'formatNoMatches'=> 'js:function(){ clear_select2_ajax("LicenciaEquipo_Id_Licencia"); return "No se encontraron resultados"; }',
                        'formatInputTooShort' =>  'js:function(){ return "Digite más de 3 caracteres para iniciar busqueda <button type=\"button\" class=\"btn btn-success btn-xs pull-right\" onclick=\"clear_select2_ajax(\'LicenciaEquipo_Id_Licencia\')\">Limpiar campo</button>"; }',
                    ),
                ));
            ?>
        </div>
    </div>
</div>

<div class="btn-group" id="buttons">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipo/view&id='.$e; ?>';"><i class="fa fa-reply"></i> Volver</button>
    <button type="button" class="btn btn-success" id="valida_form"><i class="fa fa-floppy-o"></i> Guardar</button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">


$(function() {

	$("#valida_form").click(function() {
      var form = $("#licencia-equipo-form");
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


function clear_select2_ajax(id){
  $('#'+id+'').val('').trigger('change');
  $('#s2id_'+id+' span').html("");
}
	
</script>