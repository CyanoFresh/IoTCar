<?php

namespace app\components;

use app\models\User;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use React\EventLoop\Factory;
use Yii;
use yii\helpers\Json;

class WebSocketAPI
{
    /**
     * @var string
     */
    protected $localWSSUrl;

    /**
     * WebSocketAPI constructor.
     * @param string|null $localWSSUrl
     */
    public function __construct($localWSSUrl = null)
    {
        $this->localWSSUrl = $localWSSUrl;

        if (is_null($this->localWSSUrl)) {
            $this->localWSSUrl = Yii::$app->params['wss']['localWSURL'];
        }
    }

    /**
     * @return string
     */
    protected function getWSSUrl()
    {
        return $this->localWSSUrl . '/?type=user';
    }

    /**
     * @return bool
     */
    public function moveForward()
    {
        return $this->send([
            'type' => 'move.forward',
        ]);
    }

    /**
     * @return bool
     */
    public function moveBackward()
    {
        return $this->send([
            'type' => 'move.backward',
        ]);
    }

    /**
     * @return bool
     */
    public function moveLeft()
    {
        return $this->send([
            'type' => 'move.left',
        ]);
    }

    /**
     * @return bool
     */
    public function moveRight()
    {
        return $this->send([
            'type' => 'move.right',
        ]);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function send($data)
    {
        $loop = Factory::create();
        $connector = new Connector($loop);

        $success = false;

        $connector($this->getWSSUrl(), [], ['Origin' => 'origin'])
            ->then(function (WebSocket $conn) use ($data, &$success) {
                // Send data
                $conn->send(Json::encode($data));

                // Job done. Close the connection
                $conn->close();

                $success = true;
            }, function(\Exception $e) use ($loop) {
                echo "Could not connect: {$e->getMessage()}\n";

                $loop->stop();
            });

        $loop->run();

        return $success;
    }
}
