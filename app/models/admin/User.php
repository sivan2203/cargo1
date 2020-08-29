<?php


namespace app\models\admin;


use RedBeanPHP\R;

class User extends \app\models\User
{
    public $attributes = [
        'id' => '',
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
        'role' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['name'],
            ['email'],
            ['role'],
        ],

        'email' => [
            ['email'],
        ],
    ];

    public function checkUnique(){
        $user = R::findOne('user', '(login = ? AND email = ?) AND id <> ?',
            [$this->attributes['login'], $this->attributes['email'], $this->attributes['id']]);
        if ($user){
            if ($user->login == $this->attributes['login']) $this->errors['unique'][] = 'Пользователь с таким Логинов уже существует';
            if ($user->email == $this->attributes['email']) $this->errors['unique'][] = 'Пользователь с таким Email уже существует';
            return false;
        }
        return true;
    }

}