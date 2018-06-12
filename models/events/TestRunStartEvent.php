<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 12.06.2018
 * Time: 17:33
 */

namespace app\models\events;


use yii\base\Event;

class TestRunStartEvent extends Event
{
    public $id;

}