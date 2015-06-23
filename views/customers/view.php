<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model backend\Models\Orders */

$this->title = $model->contactname;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['indexcust']];
?>
<div class="orders-view">

    <h1><?= Html::encode($model->contactname) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'contactname',
            'email:email',
            'phone',
            'companycode',
           /* 'appOrderplan.appname',
            'status',
            'orderfrom',
            'appOrderplan.plancaption',
            'orderkey',
            'created',
            'creator',
            'edited',
            'editor',*/
        ],
    ]) ?>

</div>
<div>
    <?= Tabs::widget([
    'items' => [
        [
           'label' => 'Log',
           'content'=> 'Lod data User',
           // 'active' => true
        ],
        [
            'label' => 'Order',
            'content' => $this->render('_apps', ['dataProviderDt' => new ActiveDataProvider(['query' => $model->getApps()]),] ), 
            'active' => true
        ],
    ],
]);
?>
</div>
