<?php
/* @var $this FactItemContController */
/* @var $data FactItemCont */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Fac')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Fac), array('view', 'id'=>$data->Id_Fac)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Contrato')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Items')); ?>:</b>
	<?php echo CHtml::encode($data->Items); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Numero_Factura')); ?>:</b>
	<?php echo CHtml::encode($data->Numero_Factura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Factura')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Factura); ?>
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