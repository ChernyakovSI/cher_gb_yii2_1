<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 12.06.2018
 * Time: 20:14
 */

namespace app\models\events;

use yii\base\Event;

class AfterNewTaskCreated extends Event
{
    public $Email;

}