<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 03.06.2018
 * Time: 20:38
 */

namespace app\widgets;


use yii\base\Widget;

class MyWidget extends Widget
{
    public $message;

    public function init() {
        parent::init();
        echo '----------';
    }

    public function run() {
        return $this->render('My widget', ['message' => 'this is test']);//$this->message;
    }
}