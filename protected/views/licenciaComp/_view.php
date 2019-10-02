<?php
/* @var $this LicenciaCompController */
/* @var $data LicenciaComp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Licencia_Comp')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Licencia_Comp), array('view', 'id'=>$data->Id_Licencia_Comp)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Software')); ?>:</b>
	<?php echo CHtml::encode($data->Software); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Serial')); ?>:</b>
	<?php echo CHtml::encode($data->Serial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cant_Usuarios')); ?>:</b>
	<?php echo CHtml::encode($data->Cant_Usuarios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Notas')); ?>:</b>
	<?php echo CHtml::encode($data->Notas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Inicio_Sop')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Inicio_Sop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Final_Sop')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Final_Sop); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->Proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa_Compra')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa_Compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Factura_Compra')); ?>:</b>
	<?php echo CHtml::encode($data->Factura_Compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Compra')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Valor_Comercial')); ?>:</b>
	<?php echo CHtml::encode($data->Valor_Comercial); ?>
	<br />

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