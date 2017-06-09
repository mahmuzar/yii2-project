<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
use yii\db\mssql\PDO;

class ProductImages extends Model {

    public $id;
    public $name;
    public $size;
    public $description;

    public function rules() {
        return[
            ['name', 'required'],
            [['id', 'size', 'description'], 'safe']
        ];
    }

    /**
     * 
     * @param \yii\web\UploadedFile $file
     */
    function save(\yii\web\UploadedFile $file) {
        \Yii::$app->db->createCommand(
                        '
                INSERT
                INTO
                    `product_images`(
                    `product_images`.`name`,
                    `product_images`.`size`
                    )
                VALUES(:name, :size);'
                )
                ->bindParam(':name', $file->name)
                ->bindParam(':size', $file->size)->query();
    }

    function findAll() {
        return \Yii::$app->db->createCommand(
                        '
                SELECT
                  *
                FROM
                  `product_images`'
                )->queryAll(PDO::FETCH_ASSOC);
    }

}
