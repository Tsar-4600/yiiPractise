<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\RegForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\widgets\MaskedInput;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
        <?= $form->field($regData, 'username')->textInput(); ?>
        <?= $form->field($regData, 'password')->passwordInput(); ?>
        <?= $form->field($regData, 'confirmPassword')->passwordInput(); ?>
        <?= $form->field($regData, 'name')->textInput(); ?>
        <?= $form->field($regData, 'surname')->textInput(); ?>
        <?= $form->field($regData, 'email')->input('email');?>
        <?= $form->field($regData, 'telephone')->widget(MaskedInput::className(),['mask' => '+7 (999) 999-99-99'] )->textInput(['placeholder' => '+7 (999) 999-99-99', 'class' =>'']); ?>
        <?= $form->field($regData, 'agree')->checkbox(); ?>


        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Regsiter', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
