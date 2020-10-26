<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;

use yii\grid\GridView;

?>

<div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'income',
            'description'
        ],
    ]); ?>
</div>


