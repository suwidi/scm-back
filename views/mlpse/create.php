<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MLpse */

$this->title = 'Create Mlpse';
$this->params['breadcrumbs'][] = ['label' => 'Mlpses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlpse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
