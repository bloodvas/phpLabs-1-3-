<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;
    public $dateCheck;
    public $yOld;
    public $favFood;
    public $radioFeedback;
    public $feedback;

    public function rules()
    {
        return [
            [['name', 'email', 'yOld', 'dateCheck', 'feedback', 'radioFeedback', 'favFood'], 'required'],
            ['email', 'email'],
            [['name'], 'string', 'min'=>5, 'max' => 30],
            [['yOld'], 'integer', 'min'=>18, 'max' => 100],
            [['feedback'], 'filter', 'filter'=>'strip_tags']
        ];
    }

    public function validateName()
    {
        $user = User::findByUsername($this->username);

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Неправильное имя пользователя или пароль.');
        }
    }
}
