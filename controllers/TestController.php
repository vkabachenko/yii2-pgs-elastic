<?php


namespace app\controllers;


use app\models\Company;
use app\models\CompanySearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isPost) {
            $term = \Yii::$app->request->post('term');
            //$companySearch = CompanySearch::find()->query(['match' => ['name' => $term]])->all();
            $companySearch = CompanySearch::find()->query(
                ['multi_match' => [
                    'query' => $term,
                    'fields' => [
                        'name^3',
                        'description'
                    ]
                ]
            ])->all();
            $ids = ArrayHelper::getColumn($companySearch, '_id');
            $dataProvider = new ActiveDataProvider([
                'query' => Company::find()->where(['id' => $ids])
            ]);
        } else {
            $term = null;
            $dataProvider = new ActiveDataProvider([
                'query' => Company::find()
            ]);
        }

        return $this->render('index', compact('dataProvider', 'term'));
    }

}