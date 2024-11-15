<?php

use app\models\Film;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FilmSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Фильмы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить фильм', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
               'attribute'=> 'id_genre',
               'value' => function($model)
               {
                    return $model->genre->name;
               }
            ],
            [
                'attribute' => 'photo_path',
                'format' => 'html', // Указывать, что формат будет HTML
                'value' => function ($model) {
                    // Здесь замените 'your_image_folder/' на путь к вашей папке с изображениями
                    return Html::img('@web/images/' . $model->photo_path, [
                        'alt' => 'Image', // Альтернативный текст
                        'style' => 'width:250px; height:auto;' // Установите ширину изображения, чтобы оно помещалось в таблицу
                    ]);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Film $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_film' => $model->id_film]);
                 }
            ],
        ],
    ]); ?>


</div>
