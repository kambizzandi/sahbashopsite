<?php

namespace app\controllers;

use app\modules\panel\models\BasketItemModel;
use app\modules\panel\models\BasketModel;
use app\modules\panel\models\ProductModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BasketController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'index',
                    'add-to-basket',
                    'remove-from-basket',
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'add-to-basket',
                            'remove-from-basket',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('view', [
            'model' => BasketModel::find()
                ->where(['basket_userId' => Yii::$app->user->id])
                ->one()
        ]);
    }

    public function actionAddToBasket($id)
    {
        $basketModel = BasketModel::find()
            ->where(['basket_userId' => Yii::$app->user->id])
            ->one();

        if ($basketModel == null) {
            $basketModel = new BasketModel();

            $basketModel->basket_userId = Yii::$app->user->id;
            $basketModel->basket_totalPrice = 0;
        }

        $productModel = ProductModel::find()->where(['product_id' => $id])->one();
        if ($productModel == null)
            throw new \Exception('Product not found');

        $basketModel->basket_totalPrice += $productModel->product_price;

        // if ($basketModel->basket_id == null)
            $basketModel->save();

        $found = false;
        if (empty($basketModel->basketItems) == false) {
            foreach ($basketModel->basketItems as $basketItemModel) {
                if ($basketItemModel->basketItem_productId == $id) {
                    ++$basketItemModel->basketItem_qty;
                    $basketItemModel->save();
                    $found = true;
                    break;
                }
            }
        }

        //basket item
        if ($found == false) {
            $basketItemModel = new BasketItemModel();
            $basketItemModel->basketItem_basketId = $basketModel->basket_id;
            $basketItemModel->basketItem_productId = $id;
            $basketItemModel->basketItem_qty = 1;
            $basketItemModel->save();
        }

        return $this->redirect('/basket/index');
    }

    public function actionRemoveFromBasket($id)
    {
        $basketItemModel = BasketItemModel::find()
            ->where(['basketItem_id' => $id])
            ->one();

        if ($basketItemModel == null)
            throw new NotFoundHttpException('آیتم پیدا نشد');

        if ($basketItemModel->basketItemBasket->basket_userId != Yii::$app->user->id)
            throw new \Exception('این آیتم متعلق به شما نیست');

        $basketItemModel->basketItemBasket->basket_totalPrice -=
            $basketItemModel->basketItemProduct->product_price
                * $basketItemModel->basketItem_qty;

        $basketItemModel->basketItemBasket->save();

        $basketItemModel->delete();

        return $this->redirect('/basket/index');
    }

    public function actionCheckout($status=null)
    {
        $basketModel = BasketModel::find()
            ->where(['basket_userId' => Yii::$app->user->id])
            ->one();

        if ($basketModel == null || empty($basketModel->basketItems))
            throw new \Exception('سبد خرید خالی است.');

        if ($status == null) {
            return $this->render('payment', [
                'basketModel' => $basketModel,
            ]);
        }

        if ($status == true) {
            BasketItemModel::deleteAll(['basketItem_basketId' => $basketModel->basket_id]);

            return $this->render('payment-ok', [
                'basketModel' => $basketModel,
            ]);
        }

        if ($status == false) {
            return $this->render('payment-failed', [
                'basketModel' => $basketModel,
            ]);
        }

    }

}
