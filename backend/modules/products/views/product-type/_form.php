<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([ 'id' => 'form-product','options' => ['enctype' => 'multipart/form-data']])?>

    <hr class="mb-4">

    <h6 class="mb-3 text-uppercase">Informações do Tipo de Produto</h6> 
    
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control',])->hint('Digite o Nome ou Descrição do Tipo de Produto') ?>
        </div>
    </div>

    <hr class="mb-10">

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
