<?php
/* @var $this NetworkController */
/* @var $model Network */
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
	          	<?php echo $form->label($model,'Network'); ?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'Network[Network]',
						'id'=>'Network_Network',
						'data'=>$lista_net,
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
	          	<?php echo $form->label($model,'Segment'); ?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'Network[Segment]',
						'id'=>'Network_Segment',
						'data'=>$lista_seg,
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
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'host_inicial'); ?>
			    <?php echo $form->numberField($model,'host_inicial', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
	        </div>
	    </div>
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'host_final'); ?>
			    <?php echo $form->numberField($model,'host_final', array('class' => 'form-control', 'autocomplete' => 'off', 'type' => 'number')); ?>
	        </div>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'usuario_creacion'); ?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'Network[usuario_creacion]',
						'id'=>'Network_usuario_creacion',
						'data'=>$lista_usuarios,
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
	          	<?php echo $form->label($model,'Fecha_Creacion'); ?>
			    <?php echo $form->textField($model,'Fecha_Creacion', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
	        </div>
	    </div>
	    <div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'usuario_actualizacion'); ?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'Network[usuario_actualizacion]',
						'id'=>'Network_usuario_actualizacion',
						'data'=>$lista_usuarios,
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
	          	<?php echo $form->label($model,'Fecha_Actualizacion'); ?>
			    <?php echo $form->textField($model,'Fecha_Actualizacion', array('class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => true)); ?>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-sm-3">
	    	<div class="form-group">
	          	<?php echo $form->label($model,'Estado'); ?>
            	<?php
            		$this->widget('ext.select2.ESelect2',array(
						'name'=>'Network[Estado]',
						'id'=>'Network_Estado',
						'data'=>array(1 => "DISPONIBLE", 2 => "ASIGNADA A EQUIPO", 3 => "ASIGNADA DHCP"),
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
					        'mGridId' => 'network-grid', //Gridview id
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
		<?php echo CHtml::submitButton('', array('style' => 'display:none;', 'id' => 'yt0')); ?>
		<button type="submit" class="btn btn-success" id="yt0"><i class="fa fa-search"></i> Buscar</button>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

	function resetfields(){
		$('#Network_Network').val('').trigger('change');
		$('#Network_Segment').val('').trigger('change');
		$('#Network_host_inicial').val('');
		$('#Network_host_final').val('');
		$('#Network_usuario_creacion').val('').trigger('change');
		$('#Network_Fecha_Creacion').val('');
		$('#Network_usuario_actualizacion').val('').trigger('change');
		$('#Network_Fecha_Actualizacion').val('');
		$('#Network_Estado').val('').trigger('change');

		/*$('#Usuario_Id_Usuario').val('');
		$('#Usuario_Nombres').val('');
		$('#Usuario_Correo').val('');
		$('#Usuario_Usuario').val('');
		$('#Usuario_usuario_creacion').val('').trigger('change');
		$('#Usuario_Fecha_Creacion').val('');
		$('#Usuario_usuario_actualizacion').val('').trigger('change');
		$('#Usuario_Fecha_Actualizacion').val('');
		$('#Usuario_Estado').val('').trigger('change');
		$('#Usuario_orderby').val('').trigger('change');
		$('#yt0').click();*/
	}
	
</script>
