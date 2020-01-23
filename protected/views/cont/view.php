<?php
/* @var $this ContController */
/* @var $model Cont */

?>

<h3>Detalle de contrato</h3>

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

<div class="btn-group">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=Cont/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
    <?php if ($asociacion == 1) { ?>
        <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i> Opciones de contrato</button>
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Opciones de contrato</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=negCont/create&c='.$model->Id_Contrato; ?>">Asociar negociación</a></li>
            <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=anexoCont/create&c='.$model->Id_Contrato; ?>">Asociar anexo</a></li>
            <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=itemCont/create&c='.$model->Id_Contrato; ?>">Asociar item</a></li> 
            <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=factItemCont/create&c='.$model->Id_Contrato; ?>">Asociar factura</a></li> 
        </ul>
    <?php } ?>
</div>

<div class="nav-tabs-custom" style="margin-top: 2%;">
    <ul class="nav nav-tabs" style="font-size: 12px !important;">
      <li class="active"><a href="#info" data-toggle="tab">Información</a></li>
      <li><a href="#neg" data-toggle="tab">Negociaciones</a></li>
      <li><a href="#ane" data-toggle="tab">Anexo(s)</a></li>
      <li><a href="#ite" data-toggle="tab">Item(s)</a></li>
      <li><a href="#pag" data-toggle="tab">Factura(s)</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="info">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>ID</label>
                        <?php echo '<p>'.$model->Id_Contrato.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Empresa</label>
                        <?php echo '<p>'.$model->empresa->Descripcion.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Proveedor</label>
                        <?php echo '<p>'.$model->Proveedor.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Concepto</label>
                        <?php echo '<p>'. $model->Concepto_Contrato.'</p>';?>
                    </div>
                </div>
            </div>
        	<div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Contacto</label>
                        <?php echo '<p>'.$model->Contacto.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Teléfono contacto</label>
                        <?php echo '<p>'.$model->Telefono_Contacto.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>E-mail contacto</label>
                        <?php echo '<p>'.$model->Email_Contacto.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Periodicidad de pago</label>
                        <?php echo '<p>'. $model->periodicidad->Dominio.'</p>';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de inicio</label>
                        <?php echo '<p>'.UtilidadesVarias::textofecha($model->Fecha_Inicial).'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de fin.</label>
                        <?php echo '<p>'.UtilidadesVarias::textofecha($model->Fecha_Final).'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de ren. / canc.</label>
                        <?php echo '<p>'.UtilidadesVarias::textofecha($model->Fecha_Ren_Can).'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Valor</label>
                        <?php echo '<p>'.$model->VlrCont($model->Id_Contrato).'</p>';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Área</label>
                        <?php echo '<p>'.$model->Area.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3" style="word-wrap: break-word;">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <?php echo '<p>'.$model->Observaciones.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Días de alerta (antelación)</label>
                        <?php echo '<p>'.$model->Dias_Alerta.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Usuario que creo</label>
                        <?php echo '<p>'.$model->idusuariocre->Usuario.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de creación</label>
                        <?php echo '<p>'.UtilidadesVarias::textofechahora($model->Fecha_Creacion).'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Usuario que actualizó</label>
                        <?php echo '<p>'.$model->idusuarioact->Usuario.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de actualización</label>
                        <?php echo '<p>'.UtilidadesVarias::textofechahora($model->Fecha_Actualizacion).'</p>';?>
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Estado</label>
                        <?php echo '<p>'.UtilidadesVarias::textoestado1($model->Estado).'</p>';?>
                    </div>
                </div>  
            </div>
        </div>
        <div class="tab-pane" id="neg">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'neg-cont-grid',
                'dataProvider'=>$neg->search(),
                //'filter'=>$model,
                'enableSorting' => false,
                'columns'=>array(
                    'Id_Neg',
                    'Item',
                    array(
                        'name'=>'Costo',
                        'value'=>function($data){
                            return number_format($data->Costo, 0);
                        },
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name' => 'Moneda',
                        'value' => '$data->moneda->Dominio',
                    ),
                    array(
                        'name'=>'Porc_Desc',
                        'value'=>function($data){
                            return number_format($data->Porc_Desc, 2);
                        },
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name'=>'costo_final',
                        'value' => '$data->CostoFinal($data->Id_Neg)',
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name'=>'Estado',
                        'value'=>'UtilidadesVarias::textoestado1($data->Estado)',
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view}{update}',
                        'buttons'=>array(
                            'view'=>array(
                                'label'=>'<i class="fa fa-eye actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Visualizar'),
                                'url'=>'Yii::app()->createUrl("NegCont/view", array("id"=>$data->Id_Neg))',
                            ),
                            'update'=>array(
                                'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Actualizar'),
                                'url'=>'Yii::app()->createUrl("NegCont/update", array("id"=>$data->Id_Neg))',
                                'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                            ),
                        )
                    ),
                ),
            )); ?>
        </div>
        <div class="tab-pane" id="ane">
        	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'anexo-cont-grid',
				'dataProvider'=>$anexos->search(),
                //'filter'=>$model,
                'enableSorting' => false,
				'columns'=>array(
                    'Id_Anexo',
					'Titulo',
					'Descripcion',
                    array(
                        'name'=>'Estado',
                        'value'=>'UtilidadesVarias::textoestado1($data->Estado)',
                    ),
					array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view}{update}',
                        'buttons'=>array(
                            'view'=>array(
                                'label'=>'<i class="fa fa-eye actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Visualizar'),
                                'url'=>'Yii::app()->createUrl("AnexoCont/view", array("id"=>$data->Id_Anexo))',
                            ),
                            'update'=>array(
                                'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Actualizar'),
                                'url'=>'Yii::app()->createUrl("AnexoCont/update", array("id"=>$data->Id_Anexo))',
                                'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                            ),
                        )
                    ),
				),
			)); ?>
        </div>
        <div class="tab-pane" id="ite">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'item-cont-grid',
                'dataProvider'=>$items->search(),
                //'filter'=>$model,
                'enableSorting' => false,
                'columns'=>array(
                    'Id_Item',
                    'Id',
                    'Item',
                    'Descripcion',
                    array(
                        'name'=>'Cant',
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name'=>'Vlr_Unit',
                        'value'=>function($data){
                            return number_format($data->Vlr_Unit, 0);
                        },
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name' => 'Moneda',
                        'value' => '$data->moneda->Dominio',
                    ),
                    array(
                        'name'=>'Iva',
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name'=>'vlr_total',
                        'value'=>function($data){
                            return number_format($data->VlrTotalItem($data->Id_Item), 0);
                        },
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    
                    array(
                        'name'=>'Estado',
                        'value'=>'UtilidadesVarias::textoestado1($data->Estado)',
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view}{update}',
                        'buttons'=>array(
                            'view'=>array(
                                'label'=>'<i class="fa fa-eye actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Visualizar'),
                                'url'=>'Yii::app()->createUrl("ItemCont/view", array("id"=>$data->Id_Item))',
                            ),
                            'update'=>array(
                                'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Actualizar'),
                                'url'=>'Yii::app()->createUrl("ItemCont/update", array("id"=>$data->Id_Item))',
                                'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                            ),
                        )
                    ),
                ),
            )); ?>
        </div>
        <div class="tab-pane" id="pag">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'fact-item-cont-grid',
                'dataProvider'=>$facturas->search(),
                //'filter'=>$model,
                'enableSorting' => false,
                'columns'=>array(
                    'Id_Fac',
                    'Numero_Factura',
                    array(
                        'name'=>'Fecha_Factura',
                        'value'=>'UtilidadesVarias::textofecha($data->Fecha_Factura)',
                    ),
                    'Items',
                    array(
                        'name' => 'vlr_total',
                        'value' => '$data->TotalItems($data->Items)',
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                    ),
                    array(
                        'name' => 'Estado',
                        'value' => '$data->DescEstado($data->Estado)',
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view}{update}',
                        'buttons'=>array(
                            'view'=>array(
                                'label'=>'<i class="fa fa-eye actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Visualizar'),
                                'url'=>'Yii::app()->createUrl("FactItemCont/view", array("id"=>$data->Id_Fac))',
                            ),
                            'update'=>array(
                                'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Actualizar'),
                                'url'=>'Yii::app()->createUrl("FactItemCont/update", array("id"=>$data->Id_Fac))',
                                'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                            ),
                        )
                    ),
                ),
            )); ?>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->