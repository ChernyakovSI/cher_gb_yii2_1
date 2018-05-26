<?php
/**
 * Created by PhpStorm.
 * User: palad
 * Date: 26.05.2018
 * Time: 20:16
 */

namespace app\models;


use yii\base\Model;

class Test extends Model
{
    public $modelParam;

   public function  Rules() {
       return [
           //['modelParam', 'safe']
       ];
   }

}