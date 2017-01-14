<?php

namespace app\commands;

use app\servers\MainServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server;
use Ratchet\Http\OriginCheck;
use Yii;
use yii\console\Controller;

class WssController extends Controller
{
    public function actionIndex($port = 8081)
    {
        echo "Starting WS Server on port $port...\n";

        $loop = Factory::create();

        $socket = new Server($loop);
        $socket->listen($port, '0.0.0.0');

        $server = new IoServer(
            new HttpServer(
                new WsServer(
                    new MainServer($loop, Yii::$app->params['wss'])
                )
            ),
            $socket,
            $loop
        );

        $server->run();
    }
}
