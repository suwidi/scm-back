<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LpseDetailProfile */

$this->title = 'Create Lpse Detail Profile';
$this->params['breadcrumbs'][] = ['label' => 'Lpse Detail Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpse-detail-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
