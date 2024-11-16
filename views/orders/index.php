<?php

use app\models\Orders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_order',
            'id_session',
            'id_customer',
            
            'price',
            'time',
            'status_order',
            
            [
                
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_order' => $model->id_order]);
                }
            ],
            [
            
                'class' => ActionColumn::className(),
                'template' => '{cancel} {confirm}', // Убедитесь, что имена кнопок правильные
                'buttons' => [
                    'cancel' => function($url, $model) {
                        if ($model->status_order == 'Ожидает') {
                            return Html::a('Отклонить', [
                                'cancel',
                                'id' => $model->id_order
                                
                            ],
                            [
                                'class' => 'btn btn-danger'
                            ]
                            );
                        }
                    },
                    'confirm' => function($url, $model) {
                        if ($model->status_order == 'Ожидает') { // Замените условие, если нужно
                            return Html::a('Подтвердить', [
                                'confirm',
                                'id' => $model->id_order
                                

                            ],
                            [
                                'class' => 'btn btn-success'
                            ]
                            );
                        }
                        
                    },
                ],
                
            ]
        ],
    ]); ?>


</div>
