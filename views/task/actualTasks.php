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

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <td>День</td>
            <td>Задачи</td>
            <td>Количество задач</td>
        </tr>
        <?php foreach ($calendar as $cur_date => $tasks ): ?>
        <tr>
            <td class="td-date"><span class="label label-success"><?= $cur_date ?></span></td>
            <td>
                <?php foreach ($tasks as $task ) {
                    echo '<span><a href="index.php?r=task/view&id='.$task->id.'">'.$task->name.'</a></span><br>';
                } ?>
            </td>
            <td class="td-event"><?= count($tasks) ?></td>
        </tr>

        <?php endforeach; ?>
    </table>

    <? /*\app\widgets\CurrentTasks::begin([
        'dataProvider' => $calendar,
    ]);

    \app\widgets\CurrentTasks::end()*/
    ?>
</div>
