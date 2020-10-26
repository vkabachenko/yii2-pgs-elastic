<?php

namespace app\commands;

use app\models\Company;
use yii\console\Controller;
use yii\console\ExitCode;
use Faker\Factory;

class FakerController extends Controller
{
    public function actionGenerate()
    {
        $count = 100000;

        $faker = Factory::create();

        for($i = 0; $i < $count; $i++) {

            $company = new Company();
            $company->name = $faker->name;
            $company->income = rand();
            $company->description = $faker->text();

            $company->save();
        }

        echo 'Done' . "\n";

        return ExitCode::OK;
    }
}
