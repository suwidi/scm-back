<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\Models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="orders-index">
<br>
    <?= GridView::widget([
        'dataProvider' => $dataProviderDt,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'companyname',
                'format' => 'raw',
                 'value'=>function ($data) {
                    return '<b>'.$data->companycode."</b><br><font color='blue'>".$data->companyname."</font>";
                },
                'label' => 'Company',
             ],
      
            [
                'attribute' => 'orderapp',
                'format' => 'raw',
                 'value'=>function ($data) {
                    return $data->orderPlan->appname."<br><font size='1' color='red'>".$data->orderPlan->plancaption."</font>";
                },
                'label' => 'Apps',
             ],
            'status',
           [
                'label' => 'Action',            
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == 'ACTIVE'){
                        return Html::a('Run',['runapp', 'id' => $data->id]);
                    }elseif($data->status == 'OPEN'){
                        return Html::encode("Pending Activation");
                    }elseif($data->status == 'LOCKED'){
                        return Html::encode("Upload Payment");
                    }else{
                        return Html::encode("Unknown");
                    }
                    
                },
               
             ],
        ],
    ]); ?>

</div>
