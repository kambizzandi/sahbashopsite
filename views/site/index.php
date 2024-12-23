<?php

use app\modules\panel\models\ProductModel;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = Yii::t('app', 'Shop');
?>

<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h3>به فروشگاه خوش آمدید</h3>
        <p>&nbsp;</p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/product']) ?>">کالاها</a></p>
    </div>
</div>
