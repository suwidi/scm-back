<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
            <div class="col-xs-4 col-xs-offset-4 company-form">
                <div class="h-10"></div>
                <h2>Identify you here</h2>
                <div class="h-10"></div>
              <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>                
                    <div class="form-group">
                        <?= $form->field($model, 'username')->textInput(array('placeholder' => 'Email'));  ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'captcha')->widget(Captcha::className())->label(false) ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                     <div style="text-align:right">                      
                    &nbsp;&nbsp;&nbsp;&nbsp;     
                    <?= Html::submitButton("<i class='fa fa-check-circle'></i>&nbsp; Identify Me!", ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
                    </div>
                    <div class="h-10"></div>
     <?php ActiveForm::end(); ?>                  
    </div>
</div>