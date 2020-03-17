<?php
/* @var $this FactItemContController */
/* @var $model FactItemCont */

?>

<h3>Visualizando factura de contrato</h3>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'fact-item-cont-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<div class="btn-group" style="padding-bottom: 2%">
    <button type="button" class="btn btn-success"  onclick="location.href = '<?php echo Yii::app()->getBaseUrl(true).'/index.php?r=cont/view&id='.$model->Id_Contrato; ?>';"><i class="fa fa-reply"></i> Volver</button>
</div>
    
<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label>Contrato (ID / Proveedor - Concepto)</label>
            <?php  
            $mc = new Cont;
            $desc_cont = $mc->Desccontrato($model->Id_Contrato);
            echo '<p>'.$desc_cont.'</p>';
            ?>          
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>N° de fact.</label>
            <?php echo '<p>'.$model->Numero_Factura.'</p>'; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Fecha de fact.</label>
            <?php echo '<p>'.UtilidadesVarias::textofecha($model->Fecha_Factura).'</p>'; ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Tasa de cambio</label>
            <?php echo '<p>'.number_format($model->Tasa_Cambio, 2).'</p>'; ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Vlr. total</label>
            <?php echo '<p>'.$model->TotalItems($model->Id_Fac).'</p>'; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Usuario que creo</label>
            <?php echo '<p>'.$model->idusuariocre->Usuario.'</p>';?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Fecha de creación</label>
            <?php echo '<p>'.UtilidadesVarias::textofechahora($model->Fecha_Creacion).'</p>';?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Usuario que actualizó</label>
            <?php echo '<p>'.$model->idusuarioact->Usuario.'</p>';?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Fecha de actualización</label>
            <?php echo '<p>'.UtilidadesVarias::textofechahora($model->Fecha_Actualizacion).'</p>';?>
        </div>
    </div>    
    <div class="col-sm-3">
        <div class="form-group">
            <label>Estado</label>
            <?php echo '<p>'.$model->DescEstado($model->Estado).'</p>';?>
        </div>
    </div>  
</div>


<?php $this->endWidget(); ?>

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'det-fact-item-cont-grid',
    'dataProvider'=>$detalle->search(),
    //'filter'=>$model,
    'enableSorting' => false,
    'columns'=>array(
        array(
            'name'=>'Id_Item',
            'value'=>'$data->DescItem($data->Id_Item)',               
        ),
        'Cant',
        'Vlr_Unit',
        array(
            'name'=>'moneda',
            'value'=>'$data->iditem->moneda->Dominio',               
        ),
        'Iva',
        array(
            'name'=>'vlr_total',
            'value'=>'$data->TotalDet($data->Id_Det_Fac)', 
            'htmlOptions'=>array('style' => 'text-align: right;'),
        ),
    ),
));

?>