<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MLpseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master LPSE';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlpse-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     //   'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
               [
                'attribute' => 'id_lpse_inaproc',
                'label'=>'ID',
                'format' => 'raw',
                 'value'=>function ($data) {
                    return Html::a(Html::encode($data->id_lpse_inaproc),$data->link,['target'=>'_blank']);
                },
            ],
             [
                'attribute' => 'name',
                'format' => 'raw',
                 'value'=>function ($data) {
                    return Html::a(Html::encode($data->name),['view', 'id' => $data->id]);
                },
                'label' => 'Lpse',
             ],
             [
                'label' => 'Status',
                'attribute'=>'ed',
                'format' => 'raw',
                'value'=>'ed',
               
             ],
            [
                'label' => 'Action',
              //  'attribute'=>'ed',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a('Act',['grab', 'id' => $data->id]);
                },
               
             ],
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
