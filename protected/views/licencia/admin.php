<?php
/* @var $this LicenciaController */
/* @var $model Licencia */

Yii::app()->clientScript->registerScript('search', "
$('#export-excel').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('licencia-grid',{ 
        success: function() {
            window.location = '". $this->createUrl('exportexcel')  . "';
            $(\".ajax-loader\").fadeIn('fast');
            setTimeout(function(){ $(\".ajax-loader\").fadeOut('fast'); }, 10000);
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}
$('.search-button').click(function(){
	$('.search-form').toggle('fast');
	return false;
});
$('.search-form form').submit(function(){
	$('#licencia-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

//para combos de clases
$lista_clases = CHtml::listData($clases, 'Id_Dominio', 'Dominio');

//para combos de tipos
$lista_tipos = CHtml::listData($tipos, 'Id_Dominio', 'Dominio');

//para combos de versiones
$lista_versiones = CHtml::listData($versiones, 'Id_Dominio', 'Dominio');

//para combos de productos
$lista_productos = CHtml::listData($productos, 'Id_Dominio', 'Dominio');

//para combos de ubicaciones
$lista_ubicaciones = CHtml::listData($ubicaciones, 'Id_Dominio', 'Dominio');

//para combos de empresas
$lista_empresas = CHtml::listData($empresas, 'Id_Empresa', 'Descripcion');

//para combos de estados
$lista_estados = CHtml::listData($estados, 'Id_Dominio', 'Dominio');

?>

<h3>Administración de licencias</h3>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i>Realizado</h4>
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?> 

<?php if(Yii::app()->user->hasFlash('warning')):?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-info"></i>Info</h4>
      <?php echo Yii::app()->user->getFlash('warning'); ?>
    </div>
<?php endif; ?> 

<div class="btn-group" style="padding-bottom: 2%">
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=licencia/create'; ?>';"><i class="fa fa-plus"></i> Nuevo registro</button>
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
    <button type="button" class="btn btn-success" id="export-excel"><i class="fa fa-file-excel-o"></i> Exportar a excel</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'lista_clases'=>$lista_clases,
	'lista_tipos'=>$lista_tipos,
	'lista_versiones'=>$lista_versiones,
    'lista_productos'=>$lista_productos,
    'lista_ubicaciones'=>$lista_ubicaciones,
    'lista_empresas'=>$lista_empresas,
    'lista_estados'=>$lista_estados,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'licencia-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		'Id_Lic',
		array(
            'name'=>'Clasificacion',
            'value'=>'$data->clasificacion->Dominio',
        ),
        array(
            'name'=>'Tipo',
            'value'=>'$data->tipo->Dominio',
        ),

        array(
            'name'=>'Version',
            'value'=>'$data->version->Dominio',
        ),
        array(
            'name' => 'Producto',
            'value' => '($data->Producto == "") ? "-" : $data->producto->Dominio',
        ),
        array(
            'name' => 'Num_Licencia',
            'value' => '($data->Num_Licencia == "") ? "-" : $data->Num_Licencia',
        ),
        'Cant_Usuarios',
        array(
            'name' => 'cant_usuarios_disp',
            'value' => '$data->CantUsuariosRest($data->Id_Lic)',
        ),
        array(
            'name' => 'Empresa_Compra',
            'value' => '($data->Empresa_Compra == "") ? "-" : $data->empresacompra->Descripcion',
        ),
        array(
            'name' => 'Ubicacion',
            'value' => '($data->Ubicacion == "") ? "-" : $data->ubicacion->Dominio',
        ),
        'Numero_Factura',
        /*
        array(
            'name'=>'Empresa_Compra',
            'value'=>'$data->empresacompra->Descripcion',
        ),
        array(
            'name'=>'Proveedor',
            'value'=>'$data->proveedor->Proveedor',
        ),
		'Password',
		'Token',
		'Notas',
		'Numero_Inventario',
		'Numero_Factura',
		'Fecha_Factura',
		'Valor_Comercial',
		'Fecha_Inicio',
		'Fecha_Final',
		'Fecha_Inicio_Sop',
		'Fecha_Final_Sop',
		'Doc_Soporte',
		'Doc_Soporte2',
		'Id_Usuario_Creacion',
		'Fecha_Creacion',
		'Id_Usuario_Actualizacion',
		'Fecha_Actualizacion',
		*/
		array(
            'name' => 'Estado',
            'value' => '($data->Estado == "") ? "-" : $data->estado->Dominio',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{update}{ret}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'<i class="fa fa-eye actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Visualizar'),
                ),
                'update'=>array(
                    'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                    'imageUrl'=>false,
                    'options'=>array('title'=>'Actualizar'),
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true && $data->Estado != Yii::app()->params->estado_lic_ret)',
                ),
                'ret'=>array(
                    'label'=>'<i class="fa fa-toggle-off actions text-black"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createUrl("licencia/ret", array("id"=>$data->Id_Lic))',
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true && $data->CantUsuariosRest($data->Id_Lic) == $data->Cant_Usuarios && $data->Estado != Yii::app()->params->estado_lic_ret)',
                    'options'=>array('title'=>'Retirar licencia', 'confirm'=>'Esta seguro de retirar esta licencia ?'),
                ),
            )
		),
	),
)); ?>
