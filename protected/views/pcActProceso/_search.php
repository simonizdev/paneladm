<?php
/* @var $this PcActProcesoController */
/* @var $model PcActProceso */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<p>Utilice los filtros para optimizar la busqueda:</p>

<div class="row">
	<div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Id_Pc_Act_Proceso'); ?>
		    <?php echo $form->numberField($model,'Id_Pc_Act_Proceso', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
	<div class="col-sm-8">
    	<div class="form-group">
          	<?php echo $form->label($model,'Id_Proceso'); ?>
		  	<?php echo $form->textField($model,'Id_Proceso'); ?>  
          	<?php
	            $this->widget('ext.select2.ESelect2', array(
	                'selector' => '#PcActProceso_Id_Proceso',
	                'options'  => array(
	                    'allowClear' => true,
	                    'minimumInputLength' => 3,
	                    'width' => '100%',
	                    'language' => 'es',
	                    'ajax' => array(
	                        'url' => Yii::app()->createUrl('PcActProceso/SearchProceso'),
	                        'dataType'=>'json',
	                        'data'=>'js:function(term){return{q: term};}',
	                        'results'=>'js:function(data){ return {results:data};}'                   
	                    ),
	                    'formatNoMatches'=> 'js:function(){ clear_select2_ajax("PcActProceso_Id_Proceso"); return "No se encontraron resultados"; }',
	                    'formatInputTooShort' =>  'js:function(){ return "Digite más de 3 caracteres para iniciar busqueda <button type=\"button\" class=\"btn btn-success btn-xs pull-right\" onclick=\"clear_select2_ajax(\'PcActProceso_Id_Proceso\')\">Limpiar campo</button>"; }',
	                ),
	            ));
          	?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Fecha_Inicial'); ?>
		    <?php echo $form->textField($model,'Fecha_Inicial', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
        </div>
    </div>
    <div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Fecha_Final'); ?>
		    <?php echo $form->textField($model,'Fecha_Final', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
        </div>
    </div>
   	<div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Estado'); ?>
		    <?php $estados = Yii::app()->params->estados; ?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcActProceso[Estado]',
					'id'=>'PcActProceso_Estado',
					'data'=>$estados,
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
          	<?php echo $form->label($model,'orderby'); ?>
		    <?php 
            	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Demandante - Demandados ASC', 4 => 'Demandante - Demandados DESC', 5 => 'Fecha inicial ASC', 6 => 'Fecha inicial DESC', 7 => 'Fecha final ASC', 8 => 'Fecha final DESC', 9 => 'Estado ASC', 10 => 'Estado DESC');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcActProceso[orderby]',
					'id'=>'PcActProceso_orderby',
					'data'=>$array_orden,
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
          	<?php 
				$this->widget('application.extensions.PageSize.PageSize', array(
			        'mGridId' => 'pc-act-proceso-grid', //Gridview id
			        'mPageSize' => @$_GET['pageSize'],
			        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
			        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
				)); 
			?>	
        </div>
    </div>
</div>
<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success" onclick="resetfields();"><i class="fa fa-eraser"></i> Limpiar filtros</button>
    <button type="submit" class="btn btn-success" id="yt0"><i class="fa fa-search"></i> Buscar</button>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

	function resetfields(){
		$('#PcActProceso_Id_Pc_Act_Proceso').val('');
		$('#PcActProceso_Id_Proceso').val('').trigger('change');
      	$('#s2id_PcActProceso_Id_Proceso span').html("");
      	$('#PcActProceso_Fecha_Inicial').val('');
      	$('#PcActProceso_Fecha_Final').val('');
		$('#PcActProceso_Estado').val('').trigger('change');
		$('#PcActProceso_orderby').val('').trigger('change');
		$('#yt0').click();
	}

	function clear_select2_ajax(id){
      $('#'+id+'').val('').trigger('change');
      $('#s2id_'+id+' span').html("");
  	}
	
</script>