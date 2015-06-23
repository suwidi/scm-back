<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companycode')->textInput(['maxlength' => true,'disabled'=>true]) ?>
    <?= $form->field($model, 'contactname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'disabled'=>true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?php
 /*   $form->field($model, 'city')->textInput(['maxlength' => true]) 
    $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ;
    $form->field($model, 'billingaddress')->textInput(['maxlength' => true]) ;
    $form->field($model, 'billingcity')->textInput(['maxlength' => true]) ;
    $form->field($model, 'billingzipcode')->textInput(['maxlength' => true]) ;*/
    ?>
    <?= $form->field($model, 'status')->textInput(['maxlength' => true,'disabled'=>true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>