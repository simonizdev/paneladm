<?php
/* @var $this PcRegistroController */
/* @var $data PcRegistro */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Pc_Registro')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Pc_Registro), array('view', 'id'=>$data->Id_Pc_Registro)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Empresa')); ?>:</b>
	<?php echo CHtml::encode($data->Empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Marca')); ?>:</b>
	<?php echo CHtml::encode($data->Marca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Inicial')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Inicial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fecha_Final')); ?>:</b>
	<?php echo CHtml::encode($data->Fecha_Final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Origen')); ?>:</b>
	<?php echo CHtml::encode($data->Origen); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Variedad_Registro')); ?>:</b>
	<?php echo CHtml::encode($data->Variedad_Registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Expediente')); ?>:</b>
	<?php echo CHtml::encode($data->Expediente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Evidencia_Cumplimiento')); ?>:</b>
	<?php echo CHtml::encode($data->Evidencia_Cumplimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->Observaciones); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Dias_Alerta')); ?>:</b>
	<?php echo CHtml::encode($data->Dias_Alerta); ?>
	<br />

	*/ ?>

</div>