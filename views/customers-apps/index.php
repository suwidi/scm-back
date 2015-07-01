<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomeruseappsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Apps';
$this->params['breadcrumbs'][] = ['label' => 'Index', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customeruseapps-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'orderkey',          
            [
                'attribute' => 'companyname',
                'format' => 'raw',
                'value'=>function ($data) {
                   return "<b>".$data->companycode."</b>&bull;".$data->companyname."&bull;<font size='1' color='red'>".$data->customer->contactname
                   ."</font><br>".$data->customer->email."|".$data->customer->phone;
                 },
                'label' => 'Company',
            ],
            'orderPlan.appname',
            'orderPlan.plancaption',
            'dbname',
            'status',
            // 'created',
            // 'creator',
            // 'edited',
            // 'editor',
            // 'id',
            // 'dbipaddress',
            // 'dbname',
            // 'dbusername',
            // 'dbpassword',
            // 'customer_id',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
