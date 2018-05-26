<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 26.05.2018
 * Time: 20:09
 */

namespace app\controllers;


use app\models\Test;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex() {
        $testModel = new Test(['modelParam' => 'OK']);

        $arrParams = $testModel->toArray();

        return $this->render("test", $arrParams);
        //return $this->render("test", ['param1' => 'OK']);
    }
}