<?php
/* @var $this PcNacionalController */
/* @var $model PcNacional */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<p>Utilice los filtros para optimizar la busqueda:</p>

<div class="row">
	<div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Id_Pc_Nacional'); ?>
		    <?php echo $form->numberField($model,'Id_Pc_Nacional', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Empresa'); ?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacional[Empresa]',
					'id'=>'PcNacional_Empresa',
					'data'=>$lista_empresas,
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
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Descripcion'); ?>
		    <?php echo $form->textField($model,'Descripcion', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Periodicidad'); ?>
		    <?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacional[Periodicidad]',
					'id'=>'PcNacional_Periodicidad',
					'data'=>$lista_period,
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
	 <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Area'); ?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacional[Area]',
					'id'=>'PcNacional_Area',
					'data'=>$lista_areas,
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
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Tipo'); ?>
		    <?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacional[Tipo]',
					'id'=>'PcNacional_Tipo',
					'data'=>$lista_tipos,
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
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Fecha_Inicial'); ?>
		    <?php echo $form->textField($model,'Fecha_Inicial', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Fecha_Final'); ?>
		    <?php echo $form->textField($model,'Fecha_Final', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'view'); ?>
		    <?php 
            	$array_view = array(1 => 'Registros fuera de termino', 2 => 'Registros sin alerta', 3 => 'Registros inactivos');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacional[view]',
					'id'=>'PcNacional_view',
					'data'=>$array_view,
					'htmlOptions'=>array(),
				  	'options'=>array(
						'placeholder'=>'Seleccione..',
						'width'=> '100%',
						'allowClear'=>true,
					),
				));
			?>
        </div>
    </div> 
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'orderby'); ?>
		    <?php 
            	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Empresa ASC', 4 => 'Empresa DESC', 5 => 'Descripción ASC', 6 => 'Descripción DESC', 7 => 'Periodicidad ASC', 8 => 'Periodicidad DESC', 9 => 'Área ASC', 10 => 'Área DESC', 11 => 'Tipo ASC', 12 => 'Tipo DESC', 13 => 'Fecha inicial ASC', 14 => 'Fecha inicial DESC', 15 => 'Fecha final ASC', 16 => 'Fecha final DESC');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcNacional[orderby]',
					'id'=>'PcNacional_orderby',
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
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php 
				$this->widget('application.extensions.PageSize.PageSize', array(
			        'mGridId' => 'pc-nacional-grid', //Gridview id
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
		$('#PcNacional_Id_Pc_Nacional').val('');
		$('#PcNacional_Empresa').val('').trigger('change');
		$('#PcNacional_Descripcion').val('');
		$('#PcNacional_Periodicidad').val('').trigger('change');
		$('#PcNacional_Area').val('').trigger('change');
		$('#PcNacional_Tipo').val('').trigger('change');
		$('#PcNacional_Fecha_Inicial').val('');
		$('#PcNacional_Fecha_Final').val('');
		$('#PcNacional_view').val('').trigger('change');
		$('#PcNacional_orderby').val('').trigger('change');
		$('#yt0').click();
	}
	
</script>
