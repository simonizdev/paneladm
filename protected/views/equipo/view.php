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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipo/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
    <?php if ($asociacion == 1) { ?> 
        <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=licenciaEquipo/create&e='.$model->Id_Equipo; ?>';"><i class="fa fa-plus"></i> Asociar licencia a equipo</button>
    <?php } ?> 
</div>

<div class="nav-tabs-custom" style="margin-top: 2%;">
    <ul class="nav nav-tabs" style="font-size: 12px !important;">
      <li class="active"><a href="#info" data-toggle="tab">Información</a></li>
      <li><a href="#lic" data-toggle="tab">Licencia(s)</a></li>
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
      <div class="tab-pane" id="lic">
      	<?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'licencia-equipo-grid',
            'dataProvider'=>$licencias->search(),
            //'filter'=>$model,
            'enableSorting' => false,
            'columns'=>array(
    	        array(
    	            'name'=>'Id_Licencia',
    	            'value'=>'$data->idlicencia->DescLicencia($data->Id_Licencia)',
    	        ),
    	        array(
    	            'name' => 'Estado',
    	            'value' => 'UtilidadesVarias::textoestado1($data->Estado)',
    	        ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array(
                        'update'=>array(
                            'label'=>'<i class="fa fa-times actions text-black"></i>',
                            'imageUrl'=>false,
                            'url'=>'Yii::app()->createUrl("licenciaEquipo/inact", array("id"=>$data->Id_Lic_Equ, "opc"=>2))',
                            'visible'=> '(Yii::app()->user->getState("permiso_act") == true && $data->Estado == 1)',
                            'options'=>array('title'=>' Desvincular empleado', 'confirm'=>'Esta seguro de desvincular la licencia de este equipo ?'),
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



 
