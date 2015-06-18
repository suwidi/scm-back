<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MLpseProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div>
    <br>
    <p>
        <?= Html::a('Create Mlpse Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cd',
         /*   ['value'=>function ($data) {
                return $data->getProfile->name;
                },
            ],*/
            'profile_id',
            'value:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
