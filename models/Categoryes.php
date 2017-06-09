<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;

class Categoryes extends Model {

    public $id;
    public $name;
    public $description;

    public function findAll() {
        return \Yii::$app->db->createCommand('SELECT*FROM `categoryes`')->queryAll();
    }

    public function save() {
        //var_dump($this);
        return \Yii::$app->db->createCommand("
            INSERT
            INTO
                `categoryes`(
                `categoryes`.`name`,
                `categoryes`.`desctiption`
                 )
            VALUES(:name,:description)"
                        )
                        ->bindParam(':name', $this->name)
                        ->bindParam(':description', $this->description)
                        ->query();
    }
    function load($data, $formName = null) {
        var_dump($data);
        parent::load($data, $formName);
    }

}
