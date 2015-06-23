<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\Models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Page';
$this->params['breadcrumbs'][] = ['label' => 'Index', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
    <h4><?= Html::encode('Customers') ?></h4>   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],      
            [
                'attribute' => 'fullname',
                'format' => 'raw',
                 'value'=>function ($data) {
                    return "<b>".$data->fullname."</b><br>".$data->phonenumber;
                },
                'label' => 'Contact',
             ],
            'email:email',          
           [
                'label' => 'Status',
                'attribute'=>'status',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == 'OPEN'){
                        return Html::a('Activate',['actcust', 'id' => $data->order_id]);
                    }else{
                        return Html::encode($data->status);
                    }
                    
                },
               
             ],
        ],
    ]); ?>

</div>
<div class="orders-index">
    <h4><?= Html::encode("Applications") ?></h4>   
    <?= GridView::widget([
        'dataProvider' => $dataProviderApp,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],      
            [
                //'attribute' => 'companyname',
                'format' => 'raw',
                 'value'=>function ($data) {
                   return Html::a($data->customer->contactname,['viewcust', 'id' => $data->customer_id]);
                },
                'label' => 'Customers',
             ],
            [
                'attribute' => 'companyname',
                'format' => 'raw',
                'value'=>function ($data) {
                   return "<b>".$data->companycode."</b><br>".$data->companyname;
                },
                'label'=> 'Company'
            ],
           [
                'attribute' => 'orderplan',
                'format' => 'raw',
                 'value'=>function ($data) {
                   return $data->orderPlan->appname."<br><font size='1' color='red'>".$data->orderPlan->plancaption."</font>";
                },
                'label' => 'Order Plan',
             ],        
           [
                'label' => 'Status',
                'attribute'=>'status',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == 'OPEN'){
                        return Html::a('Activate',['actcust', 'id' => $data->order_id]);
                    }else{
                        return Html::encode($data->status);
                    }
                    
                },
               
             ],
        ],
    ]); ?>

</div>
