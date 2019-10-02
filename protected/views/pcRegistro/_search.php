<?php
/* @var $this PcRegistroController */
/* @var $model PcRegistro */
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
          	<?php echo $form->label($model,'Id_Pc_Registro'); ?>
		    <?php echo $form->numberField($model,'Id_Pc_Registro', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo $form->label($model,'Empresa'); ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcRegistro[Empresa]',
                    'id'=>'PcRegistro_Empresa',
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
          	<?php echo $form->label($model,'Marca'); ?>
		    <?php echo $form->textField($model,'Marca', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div> 
    </div>
     <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Origen'); ?>
		    <?php echo $form->textField($model,'Origen', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div> 
    </div>
</div>   
<div class="row">
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Descripcion'); ?>
		    <?php echo $form->textField($model,'Descripcion', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
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
   	<div class="col-sm-3">
        <div class="form-group">
            <?php echo $form->label($model,'view'); ?>
            <?php 
                $array_view = array(1 => 'Registros fuera de termino', 2 => 'Registros sin alerta', 3 => 'Registros inactivos');
            ?>
            <?php
                $this->widget('ext.select2.ESelect2',array(
                    'name'=>'PcRegistro[view]',
                    'id'=>'PcRegistro_view',
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
</div>
<div class="row"> 
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'orderby'); ?>
		    <?php 
            	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Empresa ASC', 4 => 'Empresa DESC', 5 => 'Marca ASC', 6 => 'Marca DESC', 7 => 'Origen ASC', 8 => 'Origen DESC', 9 => 'Descripción ASC', 10 => 'Descripción DESC', 11 => 'Fecha inicial ASC', 12 => 'Fecha inicial DESC', 13 => 'Fecha final ASC', 14 => 'Fecha final DESC');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcRegistro[orderby]',
					'id'=>'PcRegistro_orderby',
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
			        'mGridId' => 'pc-registro-grid', //Gridview id
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
		$('#PcRegistro_Id_Pc_Registro').val('');
		$('#PcRegistro_Empresa').val('').trigger('change');
		$('#PcRegistro_Marca').val('');
		$('#PcRegistro_Origen').val('');
		$('#PcRegistro_Descripcion').val('');
		$('#PcRegistro_Fecha_Inicial').val('');
		$('#PcRegistro_Fecha_Final').val('');
		$('#PcRegistro_view').val('').trigger('change');
		$('#PcRegistro_orderby').val('').trigger('change');
		$('#yt0').click();
	}
	
</script>


