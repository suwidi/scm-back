<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LpseDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="table-responsive">  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        /*'beforeHeader'=>[
          [
                  'columns'=>[
                      ['content'=>'Data LPSE', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                      ['content'=>'Data Update', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                  ],
                  //'options'=>['class'=>'skip-export'] // remove this row from export
              ]
          ],*/
          'columns' => [
            ['class' => 'yii\grid\SerialColumn'], 
            [
                'label' => 'Lpse',
                'attribute' => 'name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data['name']),['mlpse/view', 'id' => $data['lpse_id']]);
                  //  return Html::a(Html::encode($data->name),['view', 'id' => $data->id]);
                },
               // 'headerOptions' => ['style'=>'text-align:center'],
                
             ],
             [
                'label' => 'Lelang Aktif',
                'attribute'=>'activetotal',
                'format' => ['decimal',0],
                'value'=>'activetotal',   
                'contentOptions' => ['style'=>'text-align: center;'],                 
             ],   
             [
                'label' => 'Nilai Aktif (Rp)',
                'attribute'=>'activebudget',
                'format' => ['decimal',0],
                'value'=>'activebudget',    
                'contentOptions' => ['style'=>'text-align: right;'],           
             ],   
             [
                'label' => 'Lelang Total',
                'attribute'=>'activetotal',
                'format' => ['decimal',0],
                'value'=>'total',  
                 'contentOptions' => ['style'=>'text-align: center;'],    
             ],   
             [
                'label' => 'Nilai Akumulasi',
                'attribute'=>'budget',
               'format' => ['decimal',0],
                 'contentOptions' => ['style'=>'text-align: right;'],    
             ],                
             
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>