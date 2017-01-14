<?php

/* @var $this yii\web\View */

use app\assets\CarAsset;
use rmrevin\yii\fontawesome\FA;

CarAsset::register($this);

$this->title = 'Управление';
?>

<h1><?= $this->title ?></h1>

<div class="car-control">
    <div class="controls">
        <a href="#" class="btn btn-primary control-btn control-move-forward" data-action="move.forward"><?= FA::i('arrow-up') ?></a>
        <a href="#" class="btn btn-primary control-btn control-move-backward" data-action="move.backward"><?= FA::i('arrow-down') ?></a>
    </div>
    <div class="controls">
        <a href="#" class="btn btn-primary control-btn control-move-left" data-action="move.left"><?= FA::i('repeat') ?></a>
        <a href="#" class="btn btn-primary control-btn control-move-right" data-action="move.right"><?= FA::i('undo') ?></a>
    </div>
</div>
