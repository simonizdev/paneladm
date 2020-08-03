<?php
/* @var $this NetworkController */
/* @var $model Network */

?>

<h3>Asignación de IP(s) por DHCP</h3>

<?php $this->renderPartial('_form3', array('model'=>$model, 'lista_ips_disp'=>$lista_ips_disp)); ?>