<?php
/* @var $this AreaController */
/* @var $data Area */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Area')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Area), array('view', 'id'=>$data->Id_Area)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_UN')); ?>:</b>
	<?php echo CHtml::encode($data->Id_UN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Actualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Area')); ?>:</b>
	<?php echo CHtml::encode($data->Area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Lider_Area')); ?>:</b>
	<?php echo CHtml::encode($data->Lider_Area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email_Lider_Area')); ?>:</b>
	<?php echo CHtml::encode($data->Email_Lider_Area); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Actualizacion); ?>
	<br />

	*/ ?>

</div>