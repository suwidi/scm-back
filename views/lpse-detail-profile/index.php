<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LpseDetailProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lpse Detail Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpse-detail-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lpse Detail Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cd',
            'cb',
            'ed',
            'eb',
            // 'lpse_detail_id',
            // 'profile_id',
            // 'value:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
