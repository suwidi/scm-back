<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model backend\Models\Orders */

?>
<div class="profile-view">
    <br>
    <p>
        <?= Html::a('Update', ['updatecust', 'id' => $dataprovider->id], ['class' => 'btn btn-primary']) ?>        
    </p>
    <?= DetailView::widget([
        'model' => $dataprovider,
        'attributes' => [
            //'id',
            'contactname',
            'email:email',
            'phone',
            'status',
            'companycode',
            'address',
        ],
    ]) 
?>
</div>
