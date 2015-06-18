<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LpseDetailProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lpse-detail-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'cd')->textInput() ?>

    <?= $form->field($model, 'cb')->textInput() ?>

    <?= $form->field($model, 'ed')->textInput() ?>

    <?= $form->field($model, 'eb')->textInput() ?>

    <?= $form->field($model, 'lpse_detail_id')->textInput() ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
