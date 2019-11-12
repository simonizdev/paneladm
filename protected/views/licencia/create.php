<?php
/* @var $this LicenciaController */
/* @var $model Licencia */

//para combos de clases de licencia
$lista_clases = CHtml::listData($clases, 'Id_Dominio', 'Dominio');

//para combos de tipos de licencia
$lista_tipos = CHtml::listData($tipos, 'Id_Dominio', 'Dominio');

//para combos de versiones
$lista_versiones = CHtml::listData($versiones, 'Id_Dominio', 'Dominio');

//para combos de productos
$lista_productos = CHtml::listData($productos, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion'); 

//para combos de proveedores
$lista_proveedores = CHtml::listData($proveedores, 'Id_Proveedor', 'Proveedor'); 

//para combos de ubicaciones
$lista_ubicaciones = CHtml::listData($ubicaciones, 'Id_Dominio', 'Dominio');

//para combos de estados
$lista_estados = CHtml::listData($estados, 'Id_Dominio', 'Dominio');

?>

<h3>Creación de licencia</h3>

<?php 
	$this->renderPartial('_form', array(
		'model'=>$model, 
		'lista_clases'=>$lista_clases,
		'lista_tipos'=>$lista_tipos,
		'lista_versiones'=>$lista_versiones,
		'lista_productos'=>$lista_productos,
		'lista_empresas'=>$lista_empresas,
		'lista_proveedores'=>$lista_proveedores,
		'lista_ubicaciones'=>$lista_ubicaciones,
		'lista_estados'=>$lista_estados,
	)); 
?>