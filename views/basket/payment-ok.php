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

$this->title = Yii::t('app', 'Payment Ok');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="payment">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
