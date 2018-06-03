<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActiveRecord\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Актуальные задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <? \app\widgets\CurrentTasks::begin([
        'dataProvider' => $dataProvider,
    ]);

    \app\widgets\CurrentTasks::end()
    ?>
</div>
