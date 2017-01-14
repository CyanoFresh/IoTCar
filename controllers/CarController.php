<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\View;

class CarController extends Controller
{
    public function actionIndex()
    {
        $this->view->registerJs('var wsURL = "' . Yii::$app->params['wss']['wsURL'] . '/?type=user";', View::POS_HEAD);

        return $this->render('index');
    }
}
