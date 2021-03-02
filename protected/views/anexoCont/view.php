<?php
/* @var $this AnexoContController */
/* @var $model AnexoCont */

?>

<h3>Visualizando anexo de contrato</h3>

<div class="table-responsive">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Anexo',
		array(
            'name'=>'Id_Contrato',
            'value'=>$model->DescContrato($model->Id_Contrato),
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
    <button type="button" class="btn btn-success" onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=cont/view&id='.$model->Id_Contrato; ?>';"><i class="fa fa-reply"></i> Volver </button>
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

function renderPdfByUrl(url) {
    var currPage = 1; 
    var numPages = 0;
    var thePDF = null;

    //This is where you start
    PDFJS.getDocument(url).then(function(pdf) {

        //Set PDFJS global object (so we can easily access in our page functions
        thePDF = pdf;

        //How many pages it has
        numPages = pdf.numPages;

        //Start with first page
        pdf.getPage(1).then(handlePages);
    });


    function handlePages(page) {
        //This gives us the page's dimensions at full scale
        var viewport = page.getViewport(1);

        //We'll create a canvas for each page to draw it on
        var canvas = document.createElement("canvas");
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        //Draw it on the canvas
        page.render({
            canvasContext: context,
            viewport: viewport
        });

        //Add it to the web page
        document.getElementById('viewer').appendChild(canvas);

        //Move to next page
        currPage++;
        if (thePDF !== null && currPage <= numPages) {
            thePDF.getPage(currPage).then(handlePages);
        }
    }
}
   
</script> 

<div class="row">
    <div id="viewer" class="col-sm-12 text-center" style="display: none;">

    </div>   
</div>


<script type="text/javascript">
renderPdfByUrl('<?php echo Yii::app()->getBaseUrl(true).'/images/docs_contratos/'.$model->Doc_Soporte; ?>');
</script> 