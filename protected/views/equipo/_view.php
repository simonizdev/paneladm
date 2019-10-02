<?php
/* @var $this EquipoController */
/* @var $data Equipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Equipo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Equipo), array('view', 'id'=>$data->Id_Equipo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo_Equipo')); ?>:</b>
	<?php echo CHtml::encode($data->Tipo_Equipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Serial')); ?>:</b>
	<?php echo CHtml::encode($data->Serial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa_Compra')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa_Compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Compra')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->Proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Numero_Factura')); ?>:</b>
	<?php echo CHtml::encode($data->Numero_Factura); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Numero_Inventario')); ?>:</b>
	<?php echo CHtml::encode($data->Numero_Inventario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doc_Soporte')); ?>:</b>
	<?php echo CHtml::encode($data->Doc_Soporte); ?>
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