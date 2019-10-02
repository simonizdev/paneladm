<?php
/* @var $this EquipoOlController */
/* @var $model EquipoOl */

?>

<h3>Visualizando producto / licencia de equipo</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Equipo_Ol',
		array(
            'name'=>'Id_Equipo',
            'value'=>UtilidadesVarias::descequipo($model->Id_Equipo),
        ),
        array(
            'name'=>'Tipo_Licencia',
            'value'=>$model->tipolicencia->Dominio,
        ),
        array(
            'name'=>'Producto',
            'value'=>$model->producto->Dominio,
        ),
		'Num_Licencia',
		'Notas',
		array(
            'name'=>'Fecha_Inicio',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Inicio),
        ),
        array(
            'name'=>'Fecha_Final',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Final),
        ),
        array(
            'name'=>'Empresa_Compra',
            'value'=>$model->empresacompra->Descripcion,
        ),
        array(
            'name'=>'Proveedor',
            'value'=>$model->proveedor->Proveedor,
        ),
        'Numero_Factura',
    	array(
            'name'=>'Fecha_Factura',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Factura),
        ),
        array(
            'name' => 'Estado',
            'value' => UtilidadesVarias::textoestado1($model->Estado),
        ),
        array(
            'name'=>'Id_Usuario_Creacion',
            'value'=>$model->idusuariocre->Usuario,
        ),
        array(
            'name'=>'Fecha_Creacion',
            'value'=>UtilidadesVarias::textofechahora($model->Fecha_Creacion),
        ),
        array(
            'name'=>'Id_Usuario_Actualizacion',
            'value'=>$model->idusuarioact->Usuario,
        ),
        array(
            'name'=>'Fecha_Actualizacion',
            'value'=>UtilidadesVarias::textofechahora($model->Fecha_Actualizacion),
        ),
	),
)); ?>

</div>

<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=equipo/view&id='.$model->Id_Equipo; ?>';"><i class="fa fa-reply"></i> Volver </button>
   <button type="button" class="btn btn-success" id="toogle_button"><i class="fa fa-low-vision"></i> Ver / Ocultar Documento </button>
</div>

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

<div class="row">
    <div id="viewer" class="col-sm-12 text-center" style="display: none;">
    </div>
    <div id="viewer_img" class="col-sm-12 text-center" style="display: none;">
        <img id="img" class="img-responsive"/>
    </div>
    <div id="viewer_img2" class="col-sm-12 text-center" style="display: none; padding-bottom: 2%;">
        <img id="img2" class="img-responsive"/>
    </div>    
</div>


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
