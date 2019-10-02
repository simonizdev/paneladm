<?php
/* @var $this PcActProcesoController */
/* @var $data PcActProceso */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Pc_Act_Proceso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Pc_Act_Proceso), array('view', 'id'=>$data->Id_Pc_Act_Proceso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Proceso')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Proceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->Observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Creacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Actualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Actualizacion); ?>
	<br />

	*/ ?>

</div>