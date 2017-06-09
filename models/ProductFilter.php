<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;

class ProductFilter extends Model {

    public $categoryId;
    public $type;

    function rules() {
        return[
            [['categoryId', 'type'], 'safe']
        ];
    }

}
