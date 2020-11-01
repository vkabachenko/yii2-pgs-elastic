<?php


namespace app\commands;


use app\models\Company;
use app\models\CompanySearch;
use yii\console\Controller;
use yii\console\ExitCode;

class ElasticController extends Controller
{
    public function actionFill()
    {
        CompanySearch::createIndex();

        $company = Company::find()->orderBy('id')->one();
        while ($company) {
            /* @var $company \app\models\Company */
            $companySearch = new CompanySearch();
            $companySearch->_id = $company->id;
            $companySearch->name = $company->name;
            $companySearch->income = $company->income;
            $companySearch->description = $company->description;
            $companySearch->save();
            echo 'Done ' . $company->id . "\n";
            $company = Company::find()->where(['>', 'id', $company->id])->orderBy('id')->one();
        }

        return ExitCode::OK;
    }

    public function actionRemove()
    {
        CompanySearch::deleteIndex();
        echo 'Done ' . "\n";
        return ExitCode::OK;
    }

}