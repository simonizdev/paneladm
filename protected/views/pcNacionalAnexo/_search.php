<?php
/* @var $this PcNacionalAnexoController */
/* @var $model PcNacionalAnexo */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); 

?>

<p>Utilice los filtros para optimizar la busqueda:</p>

<div class="row">
	<div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Id_Anexo_Pc_Nacional'); ?>
		    <?php echo $form->numberField($model,'Id_Anexo_Pc_Nacional', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
	<div class="col-sm-8">
    	<div class="form-group">
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
</div>
<div class="row">
    <div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Titulo'); ?>
		    <?php echo $form->textField($model,'Titulo', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
   	<div class="col-sm-4">
    	<div class="form-group">
          	<?php echo $form->label($model,'Estado'); ?>
		    <?php $estados = Yii::app()->params->estados; ?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacionalAnexo[Estado]',
					'id'=>'PcNacionalAnexo_Estado',
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
            	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Descripción de control ASC', 4 => 'Descripción de control DESC', 5 => 'Nombre ASC', 6 => 'Nombre DESC', 7 => 'Estado ASC', 8 => 'Estado DESC');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacionalAnexo[orderby]',
					'id'=>'PcNacionalAnexo_orderby',
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
			        'mGridId' => 'pc-nacional-anexo-grid', //Gridview id
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
		$('#PcNacionalAnexo_Id_Anexo_Pc_Nacional').val('');
		$('#PcNacionalAnexo_Id_Pc_Nacional').val('').trigger('change');
      	$('#s2id_PcNacionalAnexo_Id_Pc_Nacional span').html("");
      	$('#PcNacionalAnexo_Titulo').val('');
		$('#PcNacionalAnexo_Estado').val('').trigger('change');
		$('#PcNacionalAnexo_orderby').val('').trigger('change');
		$('#yt0').click();
	}

	function clear_select2_ajax(id){
      $('#'+id+'').val('').trigger('change');
      $('#s2id_'+id+' span').html("");
  	}
	
</script>