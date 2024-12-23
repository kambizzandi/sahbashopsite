<?php

use app\modules\panel\models\BasketItemModel;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\panel\models\BasketItemSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Shopping Card');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basketItem-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if ($model != null && empty($model->basketItems) == false)
                echo Html::a(Yii::t('app', 'Check out'), ['checkout'], ['class' => 'btn btn-success']);
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        if ($model == null) {
            echo 'سبد خرید خالی است.';
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getBasketItems(),
            ]);

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'basketItem_id',
                    [
                        'attribute' => 'product_name',
                        'label' => Yii::t('app', 'Product Name'),
                        'value' => function($model) {
                            return $model->basketItemProduct->product_name;
                        },
                    ],
                    [
                        'attribute' => 'product_price',
                        'label' => Yii::t('app', 'Product Price'),
                        'value' => function($model) {
                            return $model->basketItemProduct->product_price;
                        },
                    ],

                    'basketItem_qty',

                    [
                        'class' => ActionColumn::class,
                        'template' => '{remove}',
                        'buttons' => [
                            'remove' => function ($url, $model, $key) {
                                return Html::a(Yii::t('app', 'Delete'), [
                                    '/basket/remove-from-basket',
                                    'id' => $model->basketItem_id,
                                ], [
                                    'class' => 'btn btn-sm btn-danger',
                                ]);
                            },
                        ],
                    ],

                ],
            ]);
        }
    ?>

</div>
