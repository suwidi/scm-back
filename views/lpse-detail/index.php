<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LpseDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div>  
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cd',
            'name:ntext',
/*            'orig_lpse_id', 
            ['class' => 'yii\grid\ActionColumn'], */
        ],
    ]); ?>

</div>
