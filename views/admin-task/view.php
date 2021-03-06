<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?
    //$key = 'task'.$model->id;

    if($this->beginCache('task', [
            'duration' => 20,
        //'dependency'
        //'enabled' => true
        'variation' => [$model->id, \yii::$app->language]
    ])){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'date',
                'description:ntext',
                'user_id',
            ],
        ]);
        $this->endCache();
    }
    ?>

</div>
