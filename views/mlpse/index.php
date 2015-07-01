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
   
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=Html::beginForm(['mlpse/grab'],'post');?>  
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
                  'options'=>['class'=>'skip-export'] // remove this row from export
              ]
          ],*/
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
             ['class' => 'yii\grid\CheckboxColumn'  ],
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
<?=Html::submitButton('Update', ['class' => 'btn btn-info',]);?>
<?= Html::endForm();?> 

</div>
