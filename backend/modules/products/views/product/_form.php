<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\products\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([ 'id' => 'form-product','options' => ['enctype' => 'multipart/form-data']])?>

    <hr class="mb-4">

    <h6 class="mb-3 text-uppercase">Informações do Produto</h6> 
    
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'class' => 'form-control', 'label'=>'Enter date range', 'labelOptions'=>['class'=>'col-sm-3'],])->hint('Digite o Código deste Produto') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control',])->hint('Digite o Nome ou Descrição deste Produto') ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'product_type_id')->dropdownList([ 1 => 'item 1',  2 => 'item 2' ], ['prompt'=>'Selecione um Tipo de Produto'])->hint('Selecione um Tipo para este Produto')  ?>
        </div>
    </div>

    <hr class="mb-4">

    <h6 class="mb-3 text-uppercase">Foto do Produto</h6>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'file')->fileInput()->hint('Selecione uma Foto deste Produto') ?>
        </div>
    </div>

    <hr class="mb-10">

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
