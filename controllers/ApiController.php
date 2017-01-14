<?php

namespace app\controllers;

use app\components\WebSocketAPI;
use yii\web\Controller;

class ApiController extends Controller
{
    public function actionMoveForward()
    {
        $api = new WebSocketAPI();

        return json_encode([
            'success' => $api->moveForward(),
        ]);
    }

    public function actionMoveBackward()
    {
        $api = new WebSocketAPI();

        return json_encode([
            'success' => $api->moveBackward(),
        ]);
    }

    public function actionMoveLeft()
    {
        $api = new WebSocketAPI();

        return json_encode([
            'success' => $api->moveLeft(),
        ]);
    }

    public function actionMoveRight()
    {
        $api = new WebSocketAPI();

        return json_encode([
            'success' => $api->moveRight(),
        ]);
    }
}
