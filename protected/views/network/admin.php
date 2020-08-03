<?php
/* @var $this NetworkController */
/* @var $model Network */

Yii::app()->clientScript->registerScript('search', "
$('#export-excel').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('network-grid',{ 
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
	$('#network-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

//para combos de usuarios
$lista_usuarios = CHtml::listData($usuarios, 'Usuario', 'Usuario');

?>

<h3>Administración de redes</h3>

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
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=network/create'; ?>';"><i class="fa fa-plus"></i> Nuevo segmento</button>
   <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=network/asigipdhcp'; ?>';"><i class="fa fa-plus"></i> Asociar IP(s) a DHCP</button>
    <button type="button" class="btn btn-success search-button"><i class="fa fa-filter"></i> Busqueda avanzada</button>
    <button type="button" class="btn btn-success" id="export-excel"><i class="fa fa-file-excel-o"></i> Exportar a excel</button>
</div>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'lista_usuarios'=>$lista_usuarios,
	'lista_net'=>$lista_net,
	'lista_seg'=>$lista_seg,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'network-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		array(
            'name' => 'ip',
            'value' => '$data->Ip($data->Id)',
        ),
        array(
            'name' => 'Estado',
            'value' => '$data->DescEstado($data->Id)',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{asig}{lib}',
            'buttons'=>array(
                'asig'=>array(
                    'label'=>'<i class="fa fa-sitemap actions text-black"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createUrl("network/asig", array("id"=>$data->Id))',
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true && $data->Estado == 1)',
                    'options'=>array('title'=>'Asignar IP'),
                ),
                'lib'=>array(
                    'label'=>'<i class="fa fa-chain-broken actions text-black"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createUrl("network/lib", array("id"=>$data->Id, "opc"=>1))',
                    'visible'=> '(Yii::app()->user->getState("permiso_act") == true && $data->Estado == 2 || $data->Estado == 3)',
                    'options'=>array('title'=>'Liberar IP', 'confirm'=>'Esta seguro de liberar esta IP ?'),
                ),
            )
		),
	),
)); ?>
