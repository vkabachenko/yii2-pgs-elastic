<?php

/* @var $this yii\web\View */
/* @var $term string */

use yii\helpers\Html;

?>

<div class="form-group">

    <?= Html::beginForm('', 'post', ['class' => 'search-form']) ?>

    <?= Html::textInput('term', $term, ['required' => true, 'class' => 'search-form-input control-input']) ?>
    <?= Html::submitButton('<i class="fas fa-search"></i>') ?>

    <?= Html::endForm() ?>

</div>
