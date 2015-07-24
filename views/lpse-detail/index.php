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
        $total=0;
        $budget=0;
        $activetotal=0;
        $activebudget=0;
        foreach ($dataProvider->allModels as $key => $value) {
           ?>
           <tr><td><?=$no?></td><td><?=$value['name']?></td>
           <td align='center'><?=$value['activetotal']?></td><td align='right'><?=number_format($value['activebudget'])?></td>
           <td align='center'><?=$value['total']?></td><td align='right'><?=number_format($value['budget'])?></td></tr>
        <?php
        $no++; 
        $total+=$value['total'];
        $budget+=$value['budget'];
        $activetotal+=$value['activetotal'];
        $activebudget+=$value['activebudget'];
        }
        ?>
    <tr><td>&nbsp;</td><td>Grand Total</td>
           <td align='center'><?=number_format($activetotal)?></td><td align='right'><?=number_format($activebudget)?></td>
           <td align='center'><?=number_format($total)?></td><td align='right'><?=number_format($budget)?></td></tr>    
    </tbody></table>    

</div>
