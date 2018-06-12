<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 03.06.2018
 * Time: 18:39
 */

namespace app\controllers;

use app\models\behaviors\MyBehavior;
use app\models\events\AfterNewTaskCreated;
use app\models\Test;
use yii\base\Event;
use yii\web\Controller;
use app\models\ActiveRecord\Task;
use yii\data\ActiveDataProvider;
use app\models\ActiveRecord\User;

use app\models\ActiveRecord\TaskSearch;


class TaskController extends Controller
{

    //const NEW_TASK_CREATED = 'new task created';

    /*public function actionCreate() {
        $model = new Task();

        if ($model->load(\yii::$app->request->post()) && $model->save()){
            $this->redirect(['site/index']);
        }
        return $this->render('create', ['model' => $model]);
    }*/

    public function actionCreate()
    {
        $model = new Task();

        $model->refreshDateOfCreate($model);
        if ($model->load(\yii::$app->request->post()) && $model->save()) {
            if (($cur_user = User::findOne(\yii::$app->user->id)) !== null) {
                $model->trigger($model::NEW_TASK_CREATED, new AfterNewTaskCreated(['Email' => $cur_user->email]));
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->refreshDateOfUpdate($model);
        if ($model->load(\yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $user_id = \yii::$app->user->id;
        $calendar = array_fill_keys(range(1, date("t")), []);
        $tasks = Task::getActualTasks($user_id)->all();
        foreach ($tasks as $task) {
            $date = \DateTime::createFromFormat("Y-m-d H:i:s", $task->date);
            $calendar[$date->format("j")][] = $task;
        }
        /*$dataProvider = new ActiveDataProvider([
            'query' => $tasks,
        ]);*/


        return $this->render('actualTasks', [
            //'dataProvider' => $dataProvider,
            'calendar' => $calendar
        ]);
    }

    public function actionTest() {
        $handler = function(){echo 'Тестовый обработчик сработал по событию';};
        Event::on(Test::class, Test::EVENT_RUN_START, $handler);
        Event::off(Test::class, Test::EVENT_RUN_START, $handler);
        //Event::on(Test::class, Test::EVENT_RUN_START, 'actionIndex');

        $test = new Test();
        //Event::on(Test::class, Test::EVENT_RUN_START, [$test, 'run']);
        //Event::on(Test::class, Test::EVENT_RUN_START, [Task::class, 'find']);
        //$test->on(Test::EVENT_RUN_START, function(){echo 'Тестовый обработчик сработал по событию';});
        $test->run();

        $test->attachBehavior('myBehavior', ['class' => MyBehavior::class, 'message' => 'Это тестовое поведение']);
        $test->detachBehavior('myBehavior');
        $test->foo();
        exit();
    }

    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}