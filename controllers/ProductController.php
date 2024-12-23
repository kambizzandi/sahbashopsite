<?php

namespace app\controllers;

use app\modules\panel\models\ProductModel;
use app\modules\panel\models\ProductSearchModel;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ProductController extends Controller
{
    protected function findModel($product_id)
    {
        if (($model = ProductModel::findOne(['product_id' => $product_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearchModel();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($product_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id),
        ]);
    }

}
