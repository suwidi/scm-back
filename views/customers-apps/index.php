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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'orderkey',
            'companycode',
            'companyname',
            'orderPlan.appname',
            'orderPlan.plancaption',
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
