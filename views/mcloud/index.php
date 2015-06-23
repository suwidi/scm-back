<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\Models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Dashboard Admin';
?>
<h2>Main Menu</h2>
<hr>
<?= Html::a('Orders', ['ordercust'], ['class' => 'btn btn-success']) ?>&nbsp;
<?= Html::a('Apps Index', ['indexapps'], ['class' => 'btn btn-success']) ?>&nbsp;
<?= Html::a('Customers', ['indexcust'], ['class' => 'btn btn-success']) ?>