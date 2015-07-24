<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LpseDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div>  
    <br>
     <table class="table table-bordered">
       <tbody><tr><th>No</th><th>Nama</th><th>Aktif</th><th>Anggararan Aktif</th><th>Jumlah Lelang</th><th>Total Anggaran</th></tr>
        <?php
        $no=1;
        foreach ($dataProvider->allModels as $key => $value) {
           ?>
           <tr><td><?=$no?></td><td><?=$value['name']?></td>
           <td><?=$value['activetotal']?></td><td><?=$value['activebudget']?></td>
           <td><?=$value['total']?></td><td><?=$value['budget']?></td></tr>
        <?php
        $no++;
        }
        ?>
        
    </tbody></table>    

</div>
