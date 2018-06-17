<?php

namespace app\controllers;

use app\models\ActiveRecord\User;
use app\models\events\AfterNewTaskCreated;
use Yii;
use app\models\ActiveRecord\Task;
use app\models\ActiveRecord\TaskSearch;
use yii\caching\DbDependency;
use yii\filters\PageCache;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminTaskController implements the CRUD actions for Task model.
 */
class AdminTaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'cache' => [
                'class' => PageCache::class,
                'duration' => 60,
                'variations' => [\yii::$app->language],
                //'dependency' => [
                //    'class' => DbDependency::class,
                //    'sql' => ''
                //]
                'only' => ['index']
            ],
            'cache2' => [
                'class' => PageCache::class,
                'duration' => 120,
                'variations' => [\yii::$app->language],
                //'dependency' => [
                //    'class' => DbDependency::class,
                //    'sql' => ''
                //]
                'only' => ['view']
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /*$cache = \yii::$app->cache;
        $key = 'task'.$id;

        $dependency = new DbDependency();
        $dependency->sql = "SELECT count(*) FROM task";

        //$cache->flush();

        if(!$model = $cache->get($key)) {
            $model = $this->findModel($id);
            $cache->set($key, $model, \yii::$app->params['defaultCacheTime'], $dependency);
        }*/

        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        //$model->refreshDateOfCreate($model);
        $model->on(Task::EVENT_AFTER_INSERT, function($e){
            $model = new Task();
            $userId = $model->getTaskById($e->sender->user_id);
            $userTo = User::findOne(['id' => $userId]);
            $model->sendEmail(['email' => $userTo->email,
                'body' => 'Для вас создана новая задача http://yii2-1.local/index.php?r=task/view?id='.$e->sender->id,
                'subject' => 'Новая задача']);
        });
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //if (($cur_user = User::findOne(\yii::$app->user->id)) !== null) {
            //    $model->trigger($model::NEW_TASK_CREATED, new AfterNewTaskCreated(['Email' => $cur_user->email]));
            //}
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //$model->refreshDateOfUpdate($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
