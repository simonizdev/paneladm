<?php
/* @var $this ContController */
/* @var $data Cont */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Contrato')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Contrato), array('view', 'id'=>$data->Id_Contrato)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Ren_Can')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Ren_Can); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Vlr_Contrato')); ?>:</b>
	<?php echo CHtml::encode($data->Vlr_Contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Area')); ?>:</b>
	<?php echo CHtml::encode($data->Area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->Observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Periodicidad')); ?>:</b>
	<?php echo CHtml::encode($data->Periodicidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Dias_Alerta')); ?>:</b>
	<?php echo CHtml::encode($data->Dias_Alerta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Contacto')); ?>:</b>
	<?php echo CHtml::encode($data->Contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Telefono_Contacto')); ?>:</b>
	<?php echo CHtml::encode($data->Telefono_Contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email_Contacto')); ?>:</b>
	<?php echo CHtml::encode($data->Email_Contacto); ?>
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