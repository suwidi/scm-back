<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MLpseProfile */

$this->title = 'Update Mlpse Profile: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mlpse Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mlpse-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
