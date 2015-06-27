<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;
use yii\data\ActiveDataProvider;
?>
<h2>Your Applications</h2>
<br>
<div>
    <?= Tabs::widget([
    'items' => [
        [
            'label' => 'Profile',
            'content' => $this->render('_profile', ['dataprovider' => $dataprovider,] ), 
           // 'active' => true
        ],
        [
            'label' => 'Applications',
            'content' => $this->render('_apps', ['dataProviderDt' => new ActiveDataProvider(['query' => $dataprovider->getApps()]),] ), 
            'active' => true
        ],
        [
            'label' => 'Ticket',
            'content' =>"Data ticket", 
        ],
    ],
]);
?>
</div>
