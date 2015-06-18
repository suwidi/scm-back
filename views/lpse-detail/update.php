<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LpseDetail */

$this->title = 'Update Lpse Detail: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lpse Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lpse-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
