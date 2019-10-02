<?php
/* @var $this DominioController */
/* @var $model Dominio */

//para combos de opciones padre
$lista_opciones_p = CHtml::listData($opciones_p, 'Id_Dominio', 'Dominio'); 

?>

<h3>Creación de dominio</h3>    
<?php $this->renderPartial('_form', array('model'=>$model, 'lista_opciones_p'=>$lista_opciones_p)); ?>  