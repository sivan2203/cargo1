<?php


namespace app\models;


use RedBeanPHP\R;

class User extends AppModel
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
        'role' => 'user',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['name'],
            ['email'],
//            ['address'],
        ],

        'email' => [
            ['email'],
        ],

        'lengthMin'=> [
            ['password', 6],
        ]

    ];

    public function checkUnique(){
        $user = R::findOne('user', 'login = ? AND email = ?', [$this->attributes['login'], $this->attributes['email']]);
        if ($user){
            if ($user->login == $this->attributes['login']) $this->errors['unique'][] = 'Пользователь с таким Логинов уже существует';
            if ($user->email == $this->attributes['email']) $this->errors['unique'][] = 'Пользователь с таким Email уже существует';
            return false;
        }
        return true;
    }

    public function login($data, $isAdmin = false){
        $login = $data['login'];
        $password = $data['password'];
        if (isset($login) && isset($password)){
            if ($isAdmin){
                $user = R::findOne('user', "login = ? AND role = 'admin'", [$login]);
            }else {
                $user = R::findOne('user', "login = ?", [$login]);
            }
            if ($user){
                if (password_verify($password, $user->password)){
                    foreach ($user as $k => $v){
                        if ($k != 'password') $_SESSION['user'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public static function checkAuth(){
        return isset($_SESSION['user']);
    }

    public static function isAdmin(){
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }

}