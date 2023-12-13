<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\JsExpression;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [ 'confirm' => 'Você realmente deseja deletar este item?', 'method' => 'post' ]
            ]) ?>
        <?= Html::a('Visualizar Tipos de Produtos Cadastrados', ['/products/product-type'], ['class' => 'btn btn-secondary']); ?>
    </p>

    <?= DetailView::widget([ 'model' => $model, 'attributes' => ['id', 'name' ] ]) ?>

</div>
