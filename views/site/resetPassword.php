<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4 company-form">
        <div class="h-10"></div>
       <h4>Please choose your new password:</h4>
        <div class="h-10"></div>   
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>            
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'repeatpassword',['inputOptions' => ['placeholder' => 'Retype Password',],])->passwordInput()->label(false) ?>
                <?= $form->field($model, 'captcha')->widget(Captcha::className())->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
</div>

