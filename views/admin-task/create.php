<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\Task */

$this->title = 'Создание новой задачи';
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="task-create">

    <h1><?//= //Html::encode($this->title) ?></h1>

    <?//= //$this->render('_form', [
        //'model' => $model,
    //]) ?>

</div>-->

<?php
$form = ActiveForm::begin([
    'id' => 'create_task',
    'options' => [
        'class' => 'form-vertical'
    ]
]);

echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'date')->textInput(['type' => 'date']);
//echo $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, []);
echo $form->field($model, 'description')->textarea();
echo $form->field($model, 'user_id')->textInput();

echo html::submitButton("Создать", ['class' => 'btn btn-success']);

ActiveForm::end();
