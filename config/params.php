<?php

use yii\helpers\ArrayHelper;

$params = [
    'adminEmail' => 'admin@example.com',
    'wss' => [
        'domain' => 'iotcar',
        'wsURL' => 'ws://iotcar:8081',
        'localWSURL' => 'ws://127.0.0.1:8081',
    ],
];

return ArrayHelper::merge($params, require 'params-local.php');
