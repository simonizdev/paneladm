<?php
/* @var $this PcNacionalController */
/* @var $data PcNacional */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Pc_Nacional')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Pc_Nacional), array('view', 'id'=>$data->Id_Pc_Nacional)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Periodicidad')); ?>:</b>
	<?php echo CHtml::encode($data->Periodicidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Inicial')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Inicial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Final')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Actividad')); ?>:</b>
	<?php echo CHtml::encode($data->Actividad); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Area_Responsable')); ?>:</b>
	<?php echo CHtml::encode($data->Area_Responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Act')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Evidencia_Cumplimiento')); ?>:</b>
	<?php echo CHtml::encode($data->Evidencia_Cumplimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Actualización')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Actualización); ?>
	<br />

	*/ ?>

</div>