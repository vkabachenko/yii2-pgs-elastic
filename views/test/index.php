<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $term string */

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;

use yii\grid\GridView;

?>

<?= $this->render('_search', compact('term')) ?>

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


