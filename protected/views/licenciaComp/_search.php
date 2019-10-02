<?php
/* @var $this LicenciaCompController */
/* @var $model LicenciaComp */
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
	          	<?php echo $form->label($model,'Id_Licencia_Comp'); ?>
			    <?php echo $form->numberField($model,'Id_Licencia_Comp', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
	        </div>
	    </div>
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'Software'); ?>
			    <?php echo $form->textField($model,'Software', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
	        </div>
	    </div>
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'Serial'); ?>
			    <?php echo $form->textField($model,'Serial', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
	        </div>
	    </div>
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'Cant_Usuarios'); ?>
			    <?php echo $form->numberField($model,'Cant_Usuarios', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
	        </div>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'Empresa_Compra'); ?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'LicenciaComp[Empresa_Compra]',
						'id'=>'LicenciaComp_Empresa_Compra',
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
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'LicenciaComp[Proveedor]',
						'id'=>'LicenciaComp_Proveedor',
						'data'=>$lista_proveedores,
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
	          	<?php echo $form->label($model,'Estado'); ?>
			    <?php $estados = Yii::app()->params->estados; ?>
			    <?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'LicenciaComp[Estado]',
						'id'=>'LicenciaComp_Estado',
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
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'orderby'); ?>
			    <?php 
                	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Software ASC', 4 => 'Software DESC', 5 => 'Serial ASC', 6 => 'Serial DESC', 7 => 'N° de usuarios ASC', 8 => 'N° de usuarios DESC', 9 => 'Empresa que compro ASC', 10 => 'Empresa que compro DESC', 11 => 'Proveedor ASC', 12 => 'Proveedor DESC', 13 => 'Estado ASC', 14 => 'Estado DESC',
                	);
            	?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'LicenciaComp[orderby]',
						'id'=>'LicenciaComp_orderby',
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
					        'mGridId' => 'licencia-comp-grid', //Gridview id
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
		$('#LicenciaComp_Id_Licencia_Comp').val('');
		$('#LicenciaComp_Software').val('');
		$('#LicenciaComp_Serial').val('');
		$('#LicenciaComp_Cant_Usuarios').val('');
		$('#LicenciaComp_Empresa_Compra').val('').trigger('change');
		$('#LicenciaComp_Proveedor').val('').trigger('change');
		$('#LicenciaComp_Estado').val('').trigger('change');
		$('#LicenciaComp_orderby').val('').trigger('change');
		$('#yt0').click();
	}
	
</script>