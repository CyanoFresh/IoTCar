<?php

/* @var $this yii\web\View */

use app\assets\CarAsset;
use rmrevin\yii\fontawesome\FA;

CarAsset::register($this);

$this->title = 'Управление';
?>

<h1><?= $this->title ?></h1>

<div class="car-control">
    <div class="row">
        <div class="col-sm-1">
            <a href="#" class="btn btn-primary btn-block btn-lg control-btn control-move-forward" data-action="move.forward">
                <?= FA::i('arrow-up') ?>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <a href="#" class="btn btn-primary btn-block btn-lg control-btn control-move-backward" data-action="move.backward">
                <?= FA::i('arrow-down') ?>
            </a>
        </div>
    </div>
    <div class="controls">
        <a href="#" class="btn btn-default btn-lg control-btn control-move-left" data-action="move.left"><?= FA::i('undo') ?></a>
        <a href="#" class="btn btn-default btn-lg control-btn control-move-right" data-action="move.right"><?= FA::i('repeat') ?></a>
    </div>
</div>
