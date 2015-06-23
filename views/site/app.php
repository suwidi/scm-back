<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard Admin';
?>
<div class="site-index">

    <div>
        <h2>Main Apps Admin Page</h2>
            <?php  if ( \Yii::$app->user->can('CloudAdmin')){ ?>
		<h4> Backend </h4>
        <p><a class="btn btn-lg btn-success" href="?r=mlpse">LPSE</a>
        	<a class="btn btn-lg btn-success" href="?r=mcloud">Cloud</a></p>
        	<hr>
        <?php } ?>
    	<h4> Clients</h4>
        <?php  if ( \Yii::$app->user->can('CloudApps')){ ?>
    	<p><a class="btn btn-lg btn-primary" href="?r=cloudapp">Apps Page</a>
        <?php } ?>
        <?php  if ( \Yii::$app->user->can('LpseApps')){ ?>
    	<a class="btn btn-lg btn-primary" href="?r=lpseapp">LPSE Page</a></p>
        <?php } ?>
    </div>

    <div class="body-content">

        <div class="row">
            
            
        </div>

    </div>
</div>
