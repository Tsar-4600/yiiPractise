<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_session')->textInput() ?>

    <?= $form->field($model, 'id_customer')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_order')->dropDownList([
        'Ожидает' => 'Ожидает',
        'Потвержден' => 'Подтвержден',
        'Отменен' => 'Отменен',
        'Оплачен' => 'Оплачен',
        // Add more statuses as needed
    ], ['prompt' => 'Выберите статус заказа']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
