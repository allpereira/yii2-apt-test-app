<?php use yii\helpers\Html; ?>

<div class="product-create">
    
<h4 class="mb-3"> <?= Html::encode($this->title) ?> </h4>
    <?= $this->render('_form', ['model' => $model]) ?>

</div>
