<?php

use app\modules\panel\models\ProductModel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\panel\models\ProductSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'product_name',
            'product_price',

            [
                'class' => ActionColumn::class,
                'template' => '{add-to-basket}',
                'buttons' => [
                    'add-to-basket' => function ($url, $model, $key) {
                      return Html::a(Yii::t('app', 'Add to basket'), [
                        '/basket/add-to-basket',
                        'id' => $model->product_id,
                      ], [
                        'class' => 'btn btn-sm btn-success',
                      ]);
                    },
                  ],
                ],
        ],
    ]); ?>


</div>
