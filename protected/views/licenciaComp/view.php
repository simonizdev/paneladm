<?php
/* @var $this LicenciaCompController */
/* @var $model LicenciaComp */

?>

<h3>Visualizando licencia compartida</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Licencia_Comp',
		'Software',
		'Serial',
		'Cant_Usuarios',
		'Notas',
		array(
            'name'=>'Fecha_Inicio_Sop',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Inicio_Sop),
        ),
        array(
            'name'=>'Fecha_Final_Sop',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Final_Sop),
        ),
        array(
            'name'=>'Empresa_Compra',
            'value'=>$model->empresacompra->Descripcion,
        ),
        array(
            'name'=>'Fecha_Compra',
            'value'=>UtilidadesVarias::textofecha($model->Fecha_Compra),
        ),
        array(
            'name'=>'Proveedor',
            'value'=>$model->proveedor->Proveedor,
        ),
        'Factura_Compra',
    	array(
            'name'=>'Valor_Comercial',
            'value'=>function($model){
                return number_format($model->Valor_Comercial, 0);
            },
        ),
        'Numero_Inventario',
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=licenciaComp/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
   <button type="button" class="btn btn-success" id="toogle_button"><i class="fa fa-low-vision"></i> Ver / Ocultar Documento </button>
</div>

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

<div class="row">
    <div id="viewer" class="col-sm-12 text-center" style="display: none;">
    </div>   
    <div id="viewer_img" class="col-sm-12 text-center" style="display: none;">
        <img id="img" class="img-responsive"/>
    </div> 
</div>


<script type="text/javascript">

    var archivo =  "<?php echo $model->Doc_Soporte; ?>"; 
    var ext = archivo.split('.').pop();

    if($.trim(ext) == "pdf"){
        renderPDF('<?php echo Yii::app()->getBaseUrl(true).'/images/docs_equipos_licencias/licencias_comp/'.$model->Doc_Soporte; ?>', document.getElementById('viewer'));
    }else{
        $('#img').attr('src', '<?php echo Yii::app()->baseUrl."/images/docs_equipos_licencias/licencias_comp/".$model->Doc_Soporte; ?>');
    }

</script>

