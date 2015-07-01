<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = ['label' => 'Index', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="customers-index">
    <h4><?= Html::encode('Customers') ?></h4>   
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],   
            [
                'attribute' => 'contactname',
                'format' => 'raw',
                 'value'=>function ($data) {
                   return Html::a($data->contactname,['viewcust', 'id' => $data->id]);
                },
                'label' => 'Name',
             ],   
            [
                'attribute' => 'phone',
                'format' => 'raw',
                 'value'=>function ($data) {
                    return "Phone. ".$data->phone."<br> Key: <b>".$data->companycode."<b>";                },
                'label' => 'Phone',
             ],
            'email:email',          
           [
                'label' => 'Status',
                'attribute'=>'status',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == 'ACTIVE'){
                        return Html::encode($data->status) ."|". Html::a('Reset',['resetcust', 'id' => $data->id]);;
                    }else{
                        return "Unlock";
                    }                    
                },
               
             ],

        ],
    ]); ?>
</div>
</div>