<?php
/* @var $this PcContratoController */
/* @var $model PcContrato */
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
          	<?php echo $form->label($model,'Id_Pc_Contrato'); ?>
		    <?php echo $form->numberField($model,'Id_Pc_Contrato', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
	<div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Empresa'); ?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcContrato[Empresa]',
					'id'=>'PcContrato_Empresa',
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
          	<?php echo $form->label($model,'Proveedor'); ?>
		    <?php echo $form->textField($model,'Proveedor', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Concepto_Contrato'); ?>
		    <?php echo $form->textField($model,'Concepto_Contrato', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Periodicidad'); ?>
		    <?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcContrato[Periodicidad]',
					'id'=>'PcContrato_Periodicidad',
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
	 <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Area'); ?>
		    <?php echo $form->textField($model,'Area', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
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
          	<?php echo $form->label($model,'Fecha_Ren_Can'); ?>
		    <?php echo $form->textField($model,'Fecha_Ren_Can', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo $form->label($model,'view'); ?>
            <?php 
                $array_view = array(1 => 'Registros fuera de termino', 2 => 'Registros sin alerta', 3 => 'Registros inactivos');
            ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcContrato[view]',
                    'id'=>'PcContrato_view',
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
            	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Empresa ASC', 4 => 'Empresa DESC', 5 => 'Proveedor ASC', 6 => 'Proveedor DESC', 7 => 'Concepto ASC', 8 => 'Concepto DESC', 9 => 'Periodicidad ASC', 10 => 'Periodicidad DESC', 11 => 'Área ASC', 12 => 'Área DESC', 13 => 'Fecha inicial ASC', 14 => 'Fecha inicial DESC', 15 => 'Fecha final ASC', 16 => 'Fecha final DESC', 17 => 'Fecha renovación / cancelación ASC', 18 => 'Fecha renovación / cancelación DESC');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcContrato[orderby]',
					'id'=>'PcContrato_orderby',
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
			        'mGridId' => 'pc-contrato-grid', //Gridview id
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
		$('#PcContrato_Id_Pc_Contrato').val('');
		$('#PcContrato_Empresa').val('').trigger('change');
		$('#PcContrato_Proveedor').val('');
		$('#PcContrato_Concepto_Contrato').val('');
		$('#PcContrato_Periodicidad').val('').trigger('change');
		$('#PcContrato_Area').val('');
		$('#PcContrato_Fecha_Inicial').val('');
		$('#PcContrato_Fecha_Final').val('');
		$('#PcContrato_Fecha_Ren_Can').val('');
		$('#PcContrato_view').val('').trigger('change');
		$('#PcContrato_orderby').val('').trigger('change');
		$('#yt0').click();
	}
	
</script>
