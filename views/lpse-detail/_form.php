<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LpseDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lpse-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'cd')->textInput() ?>

    <?= $form->field($model, 'cb')->textInput() ?>

    <?= $form->field($model, 'ed')->textInput() ?>

    <?= $form->field($model, 'eb')->textInput() ?>

    <?= $form->field($model, 'lpse_id')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
