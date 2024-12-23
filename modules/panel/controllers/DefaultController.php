<?php

namespace app\modules\panel\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->controller->layout = '/panel';
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
