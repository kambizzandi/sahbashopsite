<?php

use app\modules\panel\models\ProductModel;
use yii\grid\GridView;

/** @var yii\web\View $this */

$this->title = Yii::t('app', 'Shop');
?>

<div class="site-index">
    <?php
        // echo GridView::widget([
        //     'dataProvider' => $dataProvider,
        //     'filterModel' => $searchModel,
        //     'columns' => [
        //         ['class' => 'yii\grid\SerialColumn'],

        //         'product_id',
        //         'product_name',
        //         'product_price',
        //         [
        //             'class' => ActionColumn::class,
        //             'urlCreator' => function ($action, ProductModel $model, $key, $index, $column) {
        //                 return Url::toRoute([$action, 'id' => $model->product_id]);
        //             }
        //         ],
        //     ],
        // ]);
    ?>
</div>
