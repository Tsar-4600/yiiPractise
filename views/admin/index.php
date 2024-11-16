<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Админка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class = "site-admin">
    <style>
        .btn-success{
            margin-bottom: 15px;
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <p class = "container d-flex flex-column">
        <?= Html::a('Управление покупателями', ['/customer'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Управление юзерами', ['/user'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Управление жанрами', ['/genre'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Управление фильмами', ['/film'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Заказы', ['/orders'], ['class' => 'btn btn-success']); ?>

    </p>
</div>