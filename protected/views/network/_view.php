<?php
/* @var $this NetworkController */
/* @var $data Network */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Network')); ?>:</b>
	<?php echo CHtml::encode($data->Network); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Segment')); ?>:</b>
	<?php echo CHtml::encode($data->Segment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Host')); ?>:</b>
	<?php echo CHtml::encode($data->Host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Notas')); ?>:</b>
	<?php echo CHtml::encode($data->Notas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Creacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Actualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Actualizacion); ?>
	<br />

	*/ ?>

</div>