<?php

namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CreateCategoryForm extends Model {

    public $name;
    public $description;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            ['name', 'required'],
            ['description', 'safe'],
        ];
    }

    public function findAll() {
        return \Yii::$app->db->createCommand('SELECT*FROM `categoryes`')->queryAll();
    }

    /**
     * Добавление новой категории в базу
     * @return TRUE|FALSE вернет true в случае успеха и false в случае неудачи
     */
    public function create() {
        return \Yii::$app->db->createCommand(
                                '
                INSERT
                INTO
                    `categoryes`(
                    `categoryes`.`name`,
                    `categoryes`.`description`
                     )
                VALUES(:name, :description);
                '
                        )
                        ->bindParam(':name', $this->name)
                        ->bindParam(':description', $this->description)
                        ->query();
    }

}
