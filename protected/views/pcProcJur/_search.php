<?php
/* @var $this PcProcJurController */
/* @var $model PcProcJur */
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
          	<?php echo $form->label($model,'Id_Pc_Proc_Jur'); ?>
		    <?php echo $form->numberField($model,'Id_Pc_Proc_Jur', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Demandante'); ?>
		    <?php echo $form->textField($model,'Demandante', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Demandados'); ?>
		    <?php echo $form->textField($model,'Demandados', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Abogado'); ?>
		    <?php echo $form->textField($model,'Abogado', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Tipo_Proceso'); ?>
		    <?php echo $form->textField($model,'Tipo_Proceso', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Fecha_Admision'); ?>
		    <?php echo $form->textField($model,'Fecha_Admision', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          	<?php echo $form->label($model,'Fecha_Contestacion'); ?>
		    <?php echo $form->textField($model,'Fecha_Contestacion', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
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
                    'name'=>'PcProcJur[view]',
                    'id'=>'PcProcJur_view',
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
            	$array_orden = array(1 => 'ID ASC', 2 => 'ID DESC', 3 => 'Demandante ASC', 4 => 'Demandante DESC', 5 => 'Demandados ASC', 6 => 'Demandados DESC', 7 => 'Abogado ASC', 8 => 'Abogado DESC', 9 => 'Tipo proceso ASC', 10 => 'Tipo proceso DESC', 11 => 'Fecha admisión ASC', 12 => 'Fecha admisión DESC', 13 => 'Fecha contestación ASC', 14 => 'Fecha contestación DESC');
        	?>
        	<?php
        		$this->widget('ext.select2.ESelect2',array(
					'name'=>'PcProcJur[orderby]',
					'id'=>'PcProcJur_orderby',
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
			        'mGridId' => 'pc-proc-jur-grid', //Gridview id
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
		$('#PcProcJur_Id_Pc_Proc_Jur').val('');
		$('#PcProcJur_Demandante').val('');
		$('#PcProcJur_Demandados').val('');
		$('#PcProcJur_Abogado').val('');
		$('#PcProcJur_Tipo_Proceso').val('').trigger('change');
		$('#PcProcJur_Fecha_Admision').val('');
		$('#PcProcJur_Fecha_Contestacion').val('');
		$('#PcProcJur_view').val('').trigger('change');
		$('#PcProcJur_orderby').val('').trigger('change');
		$('#yt0').click();
	}
	
</script>
