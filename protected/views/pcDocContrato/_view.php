<?php
/* @var $this PcDocContratoController */
/* @var $data PcDocContrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Pc_Doc_Contrato')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Pc_Doc_Contrato), array('view', 'id'=>$data->Id_Pc_Doc_Contrato)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Contrato')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doc_Soporte')); ?>:</b>
	<?php echo CHtml::encode($data->Doc_Soporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Titulo')); ?>:</b>
	<?php echo CHtml::encode($data->Titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
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