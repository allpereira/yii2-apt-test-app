<?php use yii\helpers\Html; ?>

<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>

</div>
