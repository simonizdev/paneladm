<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

//para combos de tipos
$lista_tipos = CHtml::listData($tipos_empresa, 'Id_Dominio', 'Dominio'); 

?>

<h3>Actualización de empresa</h3>    
<?php $this->renderPartial('_form', array('model'=>$model, 'lista_tipos'=>$lista_tipos)); ?>   
