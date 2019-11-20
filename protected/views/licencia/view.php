<?php
/* @var $this LicenciaController */
/* @var $model Licencia */

?>

<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true).'/components/pdf.js/pdf.js'; ?>"></script>
<script type="text/javascript">

    $(function() {

        $('.ajax-loader').fadeIn('fast');
        setTimeout(function(){ $('.ajax-loader').fadeOut('fast'); }, 3000);

        $('#toogle_button').click(function(){
            
            var archivo =  "<?php echo $model->Doc_Soporte; ?>";
            var archivo2 =  "<?php echo $model->Doc_Soporte2; ?>"; 
            var ext = archivo.split('.').pop();

            if($.trim(ext) == "pdf"){
                $('#viewer').toggle('fast');
            }else{
                $('#viewer_img').toggle('fast');
            }

            if(archivo2 != ""){
                $('#viewer_img2').toggle('fast');    
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

<h3>Detalle de licencia</h3>

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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=licencia/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
    <?php if ($asociacion == 1) { ?> 
        <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=licenciaEquipo/create2&l='.$model->Id_Lic; ?>';"><i class="fa fa-plus"></i> Asociar equipo a licencia</button>
    <?php } ?>
</div>

<div class="nav-tabs-custom" style="margin-top: 2%;">
    <ul class="nav nav-tabs" style="font-size: 12px !important;">
      <li class="active"><a href="#info" data-toggle="tab">Información</a></li>
      <li><a href="#lic" data-toggle="tab">Equipo(s)</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="info">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>ID</label>
                        <?php echo '<p>'.$model->Id_Lic.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Clasif.</label>
                        <?php echo '<p>'.$model->clasificacion->Dominio.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <?php echo '<p>'.$model->tipo->Dominio.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Versión</label>
                        <?php if($model->Version == "") { $Version = "-"; } else { $Version = $model->version->Dominio; } ?>
                        <?php echo '<p>'. $model->version->Dominio.'</p>';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Producto</label>
                        <?php if($model->Producto == "") { $Producto = "-"; } else { $Producto = $model->producto->Dominio; } ?>
                        <?php echo '<p>'.$Producto.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>ID licencia</label>
                        <?php echo '<p>'.$model->Id_Licencia.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N° de licencia</label>
                        <?php echo '<p>'.$model->Num_Licencia.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Token</label>
                        <?php if($model->Token == "") { $Token = "-"; } else { $Token = $model->Token; } ?>
                        <?php echo '<p>'.$Token.'</p>';?>
                    </div>
                </div>
            </div>
        	<div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Empresa que compro</label>
                        <?php if($model->Empresa_Compra == "") { $Empresa_Compra = "-"; } else { $Empresa_Compra = $model->empresacompra->Descripcion; } ?>
                        <?php echo '<p>'.$Empresa_Compra.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Proveedor</label>
                        <?php if($model->Proveedor == "") { $Proveedor = "-"; } else { $Proveedor = $model->proveedor->Proveedor; } ?>
                        <?php echo '<p>'.$Proveedor.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N° de factura</label>
                        <?php if($model->Numero_Factura == "") { $Numero_Factura = "-"; } else { $Numero_Factura = $model->Numero_Factura; } ?>
                        <?php echo '<p>'.$Numero_Factura.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de factura</label>
                        <?php if($model->Fecha_Factura == "") { $Fecha_Factura = "-"; } else { $Fecha_Factura = UtilidadesVarias::textofecha($model->Fecha_Factura); } ?>
                        <?php echo '<p>'.$Fecha_Factura.'</p>';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Vlr. comercial</label>
                        <?php if($model->Valor_Comercial === NULL) { $Valor_Comercial = "-"; } else { $Valor_Comercial = $model->Valor_Comercial; } ?>
                        <?php echo '<p>'.$Valor_Comercial.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de inicio</label>
                        <?php if($model->Fecha_Inicio == "") { $Fecha_Inicio = "-"; } else { $Fecha_Inicio = UtilidadesVarias::textofecha($model->Fecha_Inicio); } ?>
                        <?php echo '<p>'.$Fecha_Inicio.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de fin.</label>
                        <?php if($model->Fecha_Final == "") { $Fecha_Final = "-"; } else { $Fecha_Final = UtilidadesVarias::textofecha($model->Fecha_Final); } ?>
                        <?php echo '<p>'.$Fecha_Final.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de inicio sop.</label>
                        <?php if($model->Fecha_Inicio_Sop == "") { $Fecha_Inicio_Sop = "-"; } else { $Fecha_Inicio_Sop = UtilidadesVarias::textofecha($model->Fecha_Inicio_Sop); } ?>
                        <?php echo '<p>'.$Fecha_Inicio_Sop.'</p>';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fecha de fin. sop.</label>
                        <?php if($model->Fecha_Final_Sop == "") { $Fecha_Final_Sop = "-"; } else { $Fecha_Final_Sop = UtilidadesVarias::textofecha($model->Fecha_Final_Sop); } ?>
                        <?php echo '<p>'.$Fecha_Final_Sop.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>N° de Inventario</label>
                        <?php if($model->Numero_Inventario == "") { $Numero_Inventario = "-"; } else { $Numero_Inventario = $model->Numero_Inventario; } ?>
                        <?php echo '<p>'.$Numero_Inventario.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Cuenta de registro</label>
                        <?php if($model->Cuenta_Registro == "") { $Cuenta_Registro = "-"; } else { $Cuenta_Registro = $model->Cuenta_Registro; } ?>
                        <?php echo '<p>'.$Cuenta_Registro.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3" style="word-wrap: break-word;">
                    <div class="form-group">
                        <label>Link</label>
                        <?php if($model->Link == "") { $Link = "-"; } else { $Link = $model->Link; } ?>
                        <?php echo '<p>'.$Link.'</p>';?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Password</label>
                        <?php if($model->Password == "") { $Password = "-"; } else { $Password = $model->Password; } ?>
                        <?php echo '<p>'.$Password.'</p>';?>
                    </div>
                </div>
                 <div class="col-sm-3">
                    <div class="form-group">
                        <label>Usuarios x lic.</label>
                        <?php echo '<p>'.$model->Cant_Usuarios.'</p>'; ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Ubicación</label>
                        <?php if($model->Ubicacion == "") { $Ubicacion = "-"; } else { $Ubicacion = $model->ubicacion->Dominio; } ?>
                        <?php echo '<p>'.$Ubicacion.'</p>';?>
                    </div>
                </div>
                <div class="col-sm-3" style="word-wrap: break-word;">
                    <div class="form-group">
                        <label>Notas</label>
                        <?php if($model->Notas == "") { $Notas = "-"; } else { $Notas = $model->Notas; } ?>
                        <?php echo '<p>'.$Notas.'</p>';?>
                    </div>
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
                        <?php echo '<p>'.$model->estado->Dominio.'</p>';?>
                    </div>
                </div>  
            </div>


            <button type="button" class="btn btn-success" id="toogle_button"><i class="fa fa-low-vision"></i> Ver / ocultar soporte(s)</button>

            <div class="row">
                <div id="viewer" class="col-sm-12 text-center" style="display: none; padding-bottom: 2%;">
                </div>
                <div id="viewer_img" class="col-sm-12 text-center" style="display: none; padding-bottom: 2%;">
                    <img id="img" class="img-responsive"/>
                </div> 
                <div id="viewer_img2" class="col-sm-12 text-center" style="display: none; padding-bottom: 2%;">
                    <img id="img2" class="img-responsive"/>
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
        	            'name'=>'Id_Equipo',
        	            'value'=>'UtilidadesVarias::descequipo($data->Id_Equipo)',
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
                                'url'=>'Yii::app()->createUrl("licenciaEquipo/inact", array("id"=>$data->Id_Lic_Equ, "opc"=>1))',
                                'visible'=> '(Yii::app()->user->getState("permiso_act") == true && $data->Estado == 1)',
                                'options'=>array('title'=>' Desvincular empleado', 'confirm'=>'Esta seguro de desvincular el equipo de esta licencia ?'),
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
    var archivo2 =  "<?php echo $model->Doc_Soporte2; ?>"; 
    var ext = archivo.split('.').pop();

    if($.trim(ext) == "pdf"){
        renderPDF('<?php echo Yii::app()->getBaseUrl(true).'/images/docs_equipos_licencias/licencias/'.$model->Doc_Soporte; ?>', document.getElementById('viewer'));
    }else{
        $('#img').attr('src', '<?php echo Yii::app()->baseUrl."/images/docs_equipos_licencias/licencias/".$model->Doc_Soporte; ?>');
    }

    if(archivo2 != ""){
        $('#img2').attr('src', '<?php echo Yii::app()->baseUrl."/images/docs_equipos_licencias/licencias/".$model->Doc_Soporte2; ?>');
    }

</script> 


