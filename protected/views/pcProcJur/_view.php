<?php
/* @var $this PcProcJurController */
/* @var $data PcProcJur */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Pc_Proc_Jur')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Pc_Proc_Jur), array('view', 'id'=>$data->Id_Pc_Proc_Jur)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Demandante')); ?>:</b>
	<?php echo CHtml::encode($data->Demandante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Demandados')); ?>:</b>
	<?php echo CHtml::encode($data->Demandados); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Abogado')); ?>:</b>
	<?php echo CHtml::encode($data->Abogado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo_Proceso')); ?>:</b>
	<?php echo CHtml::encode($data->Tipo_Proceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Admision')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Admision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Constestacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Constestacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Radicado')); ?>:</b>
	<?php echo CHtml::encode($data->Radicado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Autoridad')); ?>:</b>
	<?php echo CHtml::encode($data->Autoridad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->Observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Creacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Actualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Actualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
	<br />

	*/ ?>

</div>