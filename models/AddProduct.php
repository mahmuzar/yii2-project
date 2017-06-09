<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ProductImages;

class AddProduct extends Model {

    public $name;
    public $categoryId;
    public $description;

    /**
     *
     * @var UploadedFile[]
     */
    public $imageFiles;
    /**
     *
     * @var ProductImages
     */
    public $productImages;

    function __construct($config = array()) {
        parent::__construct($config);
        $this->productImages = new ProductImages();
    }

    public function rules() {

        return [
            [['name', 'categoryId'], 'required'],
            ['description', 'safe'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function insertImage() {
        
    }

    public function upload() {

        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {

                $result = $file->saveAs(\Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $file->baseName . '.' . $file->extension);
                if ($result != FALSE) {
                    $this->productImages->save($file);
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
