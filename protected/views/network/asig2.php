<?php
/* @var $this NetworkController */
/* @var $model Network */

?>

<h3>Asignación de IP a equipo</h3>

<?php $this->renderPartial('_form4', array('model'=>$model, 'e'=>$e, 'lista_ips_disp'=>$lista_ips_disp)); ?>