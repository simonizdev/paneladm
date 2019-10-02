<?php
/* @var $this PcContratoController */
/* @var $data PcContrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Pc_Contrato')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Pc_Contrato), array('view', 'id'=>$data->Id_Pc_Contrato)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->Proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Concepto_Contrato')); ?>:</b>
	<?php echo CHtml::encode($data->Concepto_Contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Inicial')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Inicial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Final')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Vlr_Contrato')); ?>:</b>
	<?php echo CHtml::encode($data->Vlr_Contrato); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Area')); ?>:</b>
	<?php echo CHtml::encode($data->Area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->Observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doc_Adjunto')); ?>:</b>
	<?php echo CHtml::encode($data->Doc_Adjunto); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Usuario_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Usuario_Actualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Actualizacion); ?>
	<br />

	*/ ?>

</div>