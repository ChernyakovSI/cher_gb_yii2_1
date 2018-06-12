<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 12.06.2018
 * Time: 22:02
 */

namespace app\models\behaviors;

use yii\base\Behavior;

class RefreshDates extends Behavior
{
    public function refreshDateOfCreate($model) {
        $model->date_of_create = date('Y-m-d H:i:s');
    }

    public function refreshDateOfUpdate($model) {
        $model->date_of_update = date('Y-m-d H:i:s');
    }
}