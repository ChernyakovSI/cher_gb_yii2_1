<?php
/**
 @var \app\models\ActiveRecords\Task $model
 */

use \yii\widgets\ActiveForm;
use \yii\helpers\html;

//\yii\widgets\ActiveForm::widget();

//console: composer require yiisoft/yii2-jui
//console: composer require kartik_v yii2-widget-datepicker

/*echo \yii\jui\DatePicker::widget([
    'model' => $model,
    'attribute' => 'date',
    //'name' => 'my_date'
]);*/

$form = ActiveForm::begin([
    'id' => 'create_task',
    'options' => [
        'class' => 'form-vertical'
    ]
]);

echo $form->field($model, 'name')->textInput();
//echo $form->field($model, 'date')->textInput(['type' => 'date']);
echo $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, []);
echo $form->field($model, 'description')->textarea();
echo $form->field($model, 'user_id')->textInput();

echo html::submitButton("Создать", ['class' => 'btn btn-success']);

ActiveForm::end();