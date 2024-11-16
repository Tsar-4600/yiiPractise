<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class = "site-lk">
    <style>
        .btn-success{
            margin-bottom: 15px;
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <p class = "container d-flex">
        <?= Html::a('Корзина', ['/cart'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Заказы', ['/order'], ['class' => 'btn btn-success']); ?>

    </p>
</div>