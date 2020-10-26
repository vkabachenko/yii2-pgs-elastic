<?php


namespace app\controllers;


use app\models\Company;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Company::find()
        ]);

        return $this->render('index', compact('dataProvider'));
    }

}