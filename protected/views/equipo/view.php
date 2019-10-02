<?php
/* @var $this EquipoController */
/* @var $model Equipo */

?>

<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true).'/components/pdf.js/pdf.js'; ?>"></script>
<script type="text/javascript">

$(function() {

    $('.ajax-loader').fadeIn('fast');
    setTimeout(function(){ $('.ajax-loader').fadeOut('fast'); }, 3000);

    $('#toogle_button').click(function(){
        
        var archivo =  "<?php echo $model->Doc_Soporte; ?>"; 
        var ext = archivo.split('.').pop();

        if($.trim(ext) == "pdf"){
            $('#viewer').toggle('fast');
        }else{
            $('#viewer_img').toggle('fast');
        }
        
        return false;

    });

});

function renderPDF(url, canvasContainer, options) {

    var options = options || { scale: 1 };
        
    function renderPage(page) {
        var viewport = page.getViewport(options.scale);
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        canvasContainer.appendChild(canvas);
        
        page.render(renderContext);
    }
    
    function renderPages(pdfDoc) {
        for(var num = 1; num <= pdfDoc.numPages; num++)
            pdfDoc.getPage(num).then(renderPage);
    }

    PDFJS.disableWorker = true;
    PDFJS.getDocument(url).then(renderPages);

}
   
</script> 

<h3>Detalle de equipo</h3>

 <div class="btn-group">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipo/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>

    <?php if ($asociacion == 1) { ?> 
   
      <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i> Opciones de equipo</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Opciones de equipo</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipoSo/create&e='.$model->Id_Equipo; ?>">Registro licencia (S.O)</a></li>
        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipoOffice/create&e='.$model->Id_Equipo; ?>">Registro licencia (Office)</a></li>
        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipoAdobe/create&e='.$model->Id_Equipo; ?>">Registro licencia (Adobe)</a></li>
        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipoAutodesk/create&e='.$model->Id_Equipo; ?>">Registro licencia (Autodesk)</a></li>
        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipoAntivirus/create&e='.$model->Id_Equipo; ?>">Registro licencia (Antivirus)</a></li>
        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipoOl/create&e='.$model->Id_Equipo; ?>">Registro otro producto / licencia</a></li>
      </ul>
    <?php } ?> 
</div>

<div class="nav-tabs-custom" style="margin-top: 2%;">
<ul class="nav nav-tabs" style="font-size: 12px !important;">
  <li class="active"><a href="#info" data-toggle="tab">Información</a></li>
  <li><a href="#lic_so" data-toggle="tab">Licencia(s) S.O</a></li>
  <li><a href="#lic_office" data-toggle="tab">Licencia(s) office</a></li>
  <li><a href="#lic_adobe" data-toggle="tab">Licencia(s) adobe</a></li>
  <li><a href="#lic_autodesk" data-toggle="tab">Licencia(s) autodesk</a></li>
  <li><a href="#lic_antivirus" data-toggle="tab">Licencia(s) antivirus</a></li>
  <li><a href="#lic_otros" data-toggle="tab">Otros productos / licencias</a></li>
</ul>
<div class="tab-content">
  <div class="active tab-pane" id="info">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>ID</label>
                <?php echo '<p>'.$model->Id_Equipo.'</p>';?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Tipo</label>
                <?php echo '<p>'.$model->tipoequipo->Dominio.'</p>';?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Serial</label>
                <?php echo '<p>'.$model->Serial.'</p>';?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Modelo</label>
                <?php echo '<p>'.$model->Modelo.'</p>';?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Empresa que compro</label>
                <?php echo '<p>'.$model->empresacompra->Descripcion.'</p>';?>
            </div>
        </div>
         <div class="col-sm-3">
            <div class="form-group">
                <label>Fecha de compra</label>
                <?php echo '<p>'.UtilidadesVarias::textofecha($model->Fecha_Compra).'</p>';?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Proveedor</label>
                <?php echo '<p>'.$model->proveedor->Proveedor.'</p>'; ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>N° de factura</label>
                <?php echo '<p>'.$model->Numero_Factura.'</p>'; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>N° de Inventario</label>
                <?php echo '<p>'.$model->Numero_Inventario.'</p>'; ?>
            </div>
        </div>
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
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Fecha de actualización</label>
                <?php echo '<p>'.UtilidadesVarias::textofechahora($model->Fecha_Actualizacion).'</p>';?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Estado</label>
                <?php echo '<p>'.UtilidadesVarias::textoestado1($model->Estado).'</p>'; ?>
            </div>
        </div>  
    </div>
    <div class="btn-group" style="padding-bottom: 2%">
       <button type="button" class="btn btn-success" id="toogle_button"><i class="fa fa-low-vision"></i> Ver / ocultar soporte </button>
    </div>
    <div class="row">
        <div id="viewer" class="col-sm-12 text-center" style="display: none;">
        </div>
        <div id="viewer_img" class="col-sm-12 text-center" style="display: none;">
            <img id="img" class="img-responsive"/>
        </div>  
    </div>  
  </div>
  <div class="tab-pane" id="lic_so">
  	<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'equipo-so-grid',
        'dataProvider'=>$model_so->search(),
        //'filter'=>$model,
        'enableSorting' => false,
        'columns'=>array(
	        array(
	            'name'=>'Tipo_Licencia',
	            'value'=>'$data->tipolicencia->Dominio',
	        ),
	        array(
	            'name'=>'Version',
	            'value'=>'$data->version->Dominio',
	        ),
	        'Num_Licencia',
	        array(
	            'name' => 'Estado',
	            'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
	        ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'buttons'=>array(
                    'view'=>array(
                        'label'=>'<i class="fa fa-eye actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Visualizar'),
                        'url'=>'Yii::app()->createUrl("equipoSo/view", array("id"=>$data->Id_Equipo_So))',
                    ),
                    'update'=>array(
                        'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Actualizar'),
                        'url'=>'Yii::app()->createUrl("equipoSo/update", array("id"=>$data->Id_Equipo_So))',
                        'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    ),
                )
            ),
        ),
    )); ?>
  </div>
  <div class="tab-pane" id="lic_office">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'equipo-office-grid',
        'dataProvider'=>$model_off->search(),
        //'filter'=>$model,
        'enableSorting' => false,
        'columns'=>array(
            array(
                'name'=>'Tipo_Licencia',
                'value'=>'$data->tipolicencia->Dominio',
            ),
            array(
                'name'=>'Version',
                'value'=>'$data->version->Dominio',
            ),
            array(
                'name'=>'Producto',
                'value'=> '($data->Producto == "") ? "N/A" : $data->producto->Dominio',
            ),
            array(
                'name'=>'Id_Licencia',
                'value'=> '($data->Id_Licencia == "") ? "N/A" : $data->Id_Licencia',
            ),
            array(
                'name'=>'Num_Licencia',
                'value'=> '($data->Num_Licencia == "") ? "N/A" : $data->Num_Licencia',
            ),
            array(
                'name' => 'Estado',
                'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'buttons'=>array(
                    'view'=>array(
                        'label'=>'<i class="fa fa-eye actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Visualizar'),
                        'url'=>'Yii::app()->createUrl("equipoOffice/view", array("id"=>$data->Id_Equipo_Office))',
                    ),
                    'update'=>array(
                        'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Actualizar'),
                        'url'=>'Yii::app()->createUrl("equipoOffice/update", array("id"=>$data->Id_Equipo_Office))',
                        'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    ),
                )
            ),
        ),
    )); ?> 
  </div>
  <div class="tab-pane" id="lic_adobe">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'equipo-adobe-grid',
        'dataProvider'=>$model_adobe->search(),
        //'filter'=>$model,
        'enableSorting' => false,
        'columns'=>array(
            array(
                'name'=>'Tipo_Licencia',
                'value'=>'$data->tipolicencia->Dominio',
            ),
            array(
                'name'=>'Version',
                'value'=>'$data->version->Dominio',
            ),
            'Num_Licencia',
            array(
                'name' => 'Estado',
                'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'buttons'=>array(
                    'view'=>array(
                        'label'=>'<i class="fa fa-eye actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Visualizar'),
                        'url'=>'Yii::app()->createUrl("equipoAdobe/view", array("id"=>$data->Id_Equipo_Adobe))',
                    ),
                    'update'=>array(
                        'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Actualizar'),
                        'url'=>'Yii::app()->createUrl("equipoAdobe/update", array("id"=>$data->Id_Equipo_Adobe))',
                        'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    ),
                )
            ),
        ),
    )); ?>
  </div>
  <div class="tab-pane" id="lic_autodesk">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'equipo-autodesk-grid',
        'dataProvider'=>$model_autodesk->search(),
        //'filter'=>$model,
        'enableSorting' => false,
        'columns'=>array(
            array(
                'name'=>'Tipo_Licencia',
                'value'=>'$data->tipolicencia->Dominio',
            ),
            array(
                'name'=>'Version',
                'value'=>'$data->version->Dominio',
            ),
            'Num_Licencia',
            array(
                'name' => 'Estado',
                'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'buttons'=>array(
                    'view'=>array(
                        'label'=>'<i class="fa fa-eye actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Visualizar'),
                        'url'=>'Yii::app()->createUrl("equipoAutodesk/view", array("id"=>$data->Id_Equipo_Autodesk))',
                    ),
                    'update'=>array(
                        'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Actualizar'),
                        'url'=>'Yii::app()->createUrl("equipoAutodesk/update", array("id"=>$data->Id_Equipo_Autodesk))',
                        'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    ),
                )
            ),
        ),
    )); ?>
  </div>
  <div class="tab-pane" id="lic_antivirus">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'equipo-antivirus-grid',
        'dataProvider'=>$model_antivirus->search(),
        //'filter'=>$model,
        'enableSorting' => false,
        'columns'=>array(
            array(
                'name'=>'Tipo_Licencia',
                'value'=>'$data->tipolicencia->Dominio',
            ),
            array(
                'name'=>'Version',
                'value'=>'$data->version->Dominio',
            ),
            'Num_Licencia',
            array(
                'name' => 'Estado',
                'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'buttons'=>array(
                    'view'=>array(
                        'label'=>'<i class="fa fa-eye actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Visualizar'),
                        'url'=>'Yii::app()->createUrl("equipoAntivirus/view", array("id"=>$data->Id_Equipo_Antivirus))',
                    ),
                    'update'=>array(
                        'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Actualizar'),
                        'url'=>'Yii::app()->createUrl("equipoAntivirus/update", array("id"=>$data->Id_Equipo_Antivirus))',
                        'visible'=> '(Yii::app()->user->getState("permiso_act") == true)',
                    ),
                )
            ),
        ),
    )); ?> 
  </div>
  <div class="tab-pane" id="lic_otros">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'equipo-ol-grid',
        'dataProvider'=>$model_ol->search(),
        //'filter'=>$model,
        'enableSorting' => false,
        'columns'=>array(
            array(
                'name'=>'Tipo_Licencia',
                'value'=>'$data->tipolicencia->Dominio',
            ),
            array(
                'name'=>'Producto',
                'value'=>'$data->producto->Dominio',
            ),
            'Num_Licencia',
            array(
                'name' => 'Estado',
                'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'buttons'=>array(
                    'view'=>array(
                        'label'=>'<i class="fa fa-eye actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Visualizar'),
                        'url'=>'Yii::app()->createUrl("equipoOl/view", array("id"=>$data->Id_Equipo_Ol))',
                    ),
                    'update'=>array(
                        'label'=>'<i class="fa fa-pencil actions text-black"></i>',
                        'imageUrl'=>false,
                        'options'=>array('title'=>'Actualizar'),
                        'url'=>'Yii::app()->createUrl("equipoOl/update", array("id"=>$data->Id_Equipo_Ol))',
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

<script type="text/javascript">

    var archivo =  "<?php echo $model->Doc_Soporte; ?>"; 
    var ext = archivo.split('.').pop();

    if($.trim(ext) == "pdf"){
        renderPDF('<?php echo Yii::app()->getBaseUrl(true).'/images/docs_equipos_licencias/equipos/'.$model->Doc_Soporte; ?>', document.getElementById('viewer'));
    }else{
        $('#img').attr('src', '<?php echo Yii::app()->baseUrl."/images/docs_equipos_licencias/equipos/".$model->Doc_Soporte; ?>');
    }

</script>  



 
