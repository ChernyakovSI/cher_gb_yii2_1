<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 12.06.2018
 * Time: 17:44
 */

namespace app\models\behaviors;


use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public $message;

    public function foo() {
        echo $this->message;
    }
}