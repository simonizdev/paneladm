<?php
/* @var $this PcExteriorAnexoController */
/* @var $model PcExteriorAnexo */

?>

<h3>Visualizando anexo de control exterior</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Anexo_Pc_Ext',
		array(
            'name'=>'Id_Pc_Ext',
            'value'=>$model->Desc_Pc_Ext($model->Id_Pc_Ext),
        ),
		'Titulo',
		'Descripcion',
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=pcExteriorAnexo/admin'; ?>';"><i class="fa fa-reply"></i> Volver </button>
   <button type="button" class="btn btn-success" id="toogle_button"><i class="fa fa-low-vision"></i> Ver / Ocultar Documento </button>
</div>



<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true).'/components/pdf.js/pdf.js'; ?>"></script>
<script type="text/javascript">

$(function() {

    $('.ajax-loader').fadeIn('fast');
    setTimeout(function(){ $('.ajax-loader').fadeOut('fast'); }, 3000);

    $('#toogle_button').click(function(){
        $('#viewer').toggle('fast');
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
</div>


<script type="text/javascript">
renderPDF('<?php echo Yii::app()->getBaseUrl(true).'/images/docs_pc_ext/'.$model->Doc_Soporte; ?>', document.getElementById('viewer'));
</script>
