<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model backend\Models\Orders */

?>
<div class="profile-view">
    <br>
    <p>             
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
