<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\MLpse */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mlpses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlpse-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
             [
            'attribute'=>'name',
            'format'=>'raw',
            'value'=>Html::a($model->name, $model->link,['target'=>'_blank']),
             ],
            [
            'attribute'=>'Last Update',
            'format'=>'raw',
            'value'=>$model->ed,
            ],
             [
            'attribute'=>'Status',
            'format'=>'raw',
            'value'=>Html::a('Update', ['grab', 'id' =>$model->id]),
            ],
        ],
    ]) ?>

</div>
<div class="mlpse-index">
     <?=
     GridView::widget([
     'dataProvider' => new ActiveDataProvider(['query' => $model->getLpseDetails()]),
     'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
     'name']
        ]);
      ?>
     
     
</div>