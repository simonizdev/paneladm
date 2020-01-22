<?php
/* @var $this NegContController */
/* @var $data NegCont */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Neg')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Neg), array('view', 'id'=>$data->Id_Neg)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Contrato')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Item')); ?>:</b>
	<?php echo CHtml::encode($data->Item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Costo')); ?>:</b>
	<?php echo CHtml::encode($data->Costo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Moneda')); ?>:</b>
	<?php echo CHtml::encode($data->Moneda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Porc_Desc')); ?>:</b>
	<?php echo CHtml::encode($data->Porc_Desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
	<br />

	<?php /*
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