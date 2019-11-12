<?php
/* @var $this LicenciaController */
/* @var $data Licencia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Lic')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Lic), array('view', 'id'=>$data->Id_Lic)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Clasificacion')); ?>:</b>
	<?php echo CHtml::encode($data->Clasificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo')); ?>:</b>
	<?php echo CHtml::encode($data->Tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Version')); ?>:</b>
	<?php echo CHtml::encode($data->Version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Producto')); ?>:</b>
	<?php echo CHtml::encode($data->Producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Licencia')); ?>:</b>
	<?php echo CHtml::encode($data->Id_Licencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Num_Licencia')); ?>:</b>
	<?php echo CHtml::encode($data->Num_Licencia); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Num_Usuario')); ?>:</b>
	<?php echo CHtml::encode($data->Num_Usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Token')); ?>:</b>
	<?php echo CHtml::encode($data->Token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cant_Usuarios')); ?>:</b>
	<?php echo CHtml::encode($data->Cant_Usuarios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Notas')); ?>:</b>
	<?php echo CHtml::encode($data->Notas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa_Compra')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa_Compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->Proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Numero_Inventario')); ?>:</b>
	<?php echo CHtml::encode($data->Numero_Inventario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Numero_Factura')); ?>:</b>
	<?php echo CHtml::encode($data->Numero_Factura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Factura')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Factura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Valor_Comercial')); ?>:</b>
	<?php echo CHtml::encode($data->Valor_Comercial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Inicio')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Final')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Inicio_Sop')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Inicio_Sop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Final_Sop')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Final_Sop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doc_Soporte')); ?>:</b>
	<?php echo CHtml::encode($data->Doc_Soporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doc_Soporte2')); ?>:</b>
	<?php echo CHtml::encode($data->Doc_Soporte2); ?>
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