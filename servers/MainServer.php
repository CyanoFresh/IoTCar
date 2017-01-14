<?php

namespace app\servers;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use React\EventLoop\LoopInterface;
use yii\base\InvalidParamException;
use yii\helpers\Json;

class MainServer implements MessageComponentInterface
{
    /**
     * @var \React\EventLoop\LoopInterface
     */
    protected $loop;

    /**
     * @var \SplObjectStorage
     */
    protected $clients;

    /**
     * @var array Configuration
     */
    protected $config;

    /**
     * @var ConnectionInterface
     */
    protected $carClient;

    /**
     * MainServer constructor.
     *
     * Set default values and initialize class.
     *
     * @param LoopInterface $loop
     * @param array $config
     */
    public function __construct($loop, $config)
    {
        $this->loop = $loop;
        $this->config = $config;
        $this->clients = new \SplObjectStorage;

        $this->log("Started");
    }

    /**
     * @inheritdoc
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->log('New connection');

        $query = $conn->WebSocket->request->getQuery();

        $type = $query->get('type');

        if ($type === 'user') {
            if ($conn->remoteAddress == '127.0.0.1' and $conn->WebSocket->request->getHeader('Origin') == 'origin') {
                $conn->isApi = true;
                $this->log("API connection");
            } else {
                $this->log("User connection");
                $conn->send(Json::encode([
                    'type' => 'hello',
                ]));
            }

            $this->clients->attach($conn);
        } elseif ($type === 'board') {
            $this->log("Board connection");
            $conn->isCar = true;

            $this->carClient = $conn;
        }
        $this->log("Unknown connection");
    }

    /**
     * @inheritdoc
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->log('Received: ' . $msg);
        $data = Json::decode($msg);

        if (!isset($data['type'])) {
            throw new InvalidParamException('No type is defined');
        }

        switch ($data['type']) {
            case 'move.forward':
                $this->sendCar([
                    'type' => 'move.forward',
                ]);
                break;
            case 'move.backward':
                $this->sendCar([
                    'type' => 'move.backward',
                ]);
                break;
            case 'move.left':
                $this->sendCar([
                    'type' => 'move.left',
                ]);
                break;
            case 'move.right':
                $this->sendCar([
                    'type' => 'move.right',
                ]);
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public function onClose(ConnectionInterface $conn)
    {
        if ($conn->isCar) {
            $this->carClient = null;
            $this->log("Car connection closed");
        } else {
            $this->log("Connection [{$conn->resourceId}] closed");
            $this->clients->detach($conn);
        }
    }

    /**
     * @inheritdoc
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $this->log("Error: {$e->getMessage()} in file {$e->getFile()} at line {$e->getLine()}");

        $conn->close();
    }

    /**
     * @param array $data
     */
    protected function sendAll($data)
    {
        $jsonData = Json::encode($data);

        foreach ($this->clients as $client) {
            $client->send($jsonData);
        }
    }

    /**
     * @param array $data
     */
    protected function sendCar($data)
    {
        if ($this->carClient === null) {
            $this->log("Car is not connected");
            return;
        }

        $jsonData = Json::encode($data);

        $this->carClient->send($jsonData);
    }

    /**
     * @param string $message
     * @param bool $newLine
     */
    protected function log($message, $newLine = true)
    {
        echo $message . ($newLine ? PHP_EOL : null);
    }
}
