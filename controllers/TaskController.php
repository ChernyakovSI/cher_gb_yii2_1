<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 03.06.2018
 * Time: 18:39
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\ActiveRecord\Task;
use yii\data\ActiveDataProvider;
use app\models\ActiveRecord\User;

use app\models\ActiveRecord\TaskSearch;


class TaskController extends Controller
{
    public function actionCreate() {
        $model = new Task();

        if ($model->load(\yii::$app->request->post()) && $model->save()){
            $this->redirect(['site/index']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionIndex()
    {
        $query = Task::find()->where([
            'user_id' => \yii::$app->user->id,
        ])->andWhere("MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW())");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $this->render('actualTasks', [
            'dataProvider' => $dataProvider,
        ]);
    }
}