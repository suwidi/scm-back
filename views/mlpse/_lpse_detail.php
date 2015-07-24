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
             [
                'label' => 'Update',
                'attribute'=>'cd',              
                'value'=>'cd',   
                'contentOptions' => ['style'=>'width: 150px;'],                 
             ],   
            'name:ntext',
            [
                'label' => 'Nilai',
                'attribute'=>'budget',
                'format' => ['decimal',0],
                'value'=>'budget',   
                'contentOptions' => ['style'=>'text-align: right;'],                 
             ],   
            'last_status'
/*            'orig_lpse_id', 
            ['class' => 'yii\grid\ActionColumn'], */
        ],
    ]); ?>

</div>