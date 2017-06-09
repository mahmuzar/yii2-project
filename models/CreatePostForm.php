<?php

namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CreatePostForm extends Model {

    public $name;
    public $forumId;
    public $text;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [    
            
            [['name', 'forumId', 'text'], 'required']
        ];
    }

}
