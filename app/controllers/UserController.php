<?php


namespace app\controllers;


use app\models\User;
use RedBeanPHP\R;


class UserController extends AppController
{
    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            //debug($data, true);
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if ($user->save('user')) {
                    $_SESSION['success'] = 'Пользователь зарегистрирован!';
                    //записываем данные нового пользователя в ссесию и авторизовываем
                    foreach ($data as $k => $v){
                        if (!$data['passwword']) $_SESSION['user'][$k] = $v;
                    }
                }else {
                    $_SESSION['errors'] = 'Ошибка';
                }

            }
            redirect('/');
        }
        $this->setMeta('Регистрация');

    }

    public function loginAction()
    {
        if (!empty($_POST)){
            $user = new User();
            $data = $_POST;
            if ($user->login($data)) {
                $_SESSION['success'] = 'Вы успешно авторизованы!';
                redirect('/');
            }else {
                $_SESSION['errors'] = 'Логин или пароль не верный!';
            }
        }
        $this->setMeta('Вход в аккаунт');

    }

    public function logoutAction()
    {
        if ($_SESSION['user']) unset($_SESSION['user']);
        redirect();

    }

    public function editAction(){
        if(!User::checkAuth()) redirect('/user/login');
        if (!empty($_POST)){
            $user = new \app\models\admin\User();
            $data = $_POST;
            $data['id'] = $_SESSION['user']['id'];
            $data['role'] = $_SESSION['user']['role'];
            $user->load($data);
            if (!$user->attributes['password']){
                unset($user->attributes['password']);
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if (!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                redirect();
            }
            if ($user->update('user', $_SESSION['user']['id'])){
                foreach ($user->attributes as $k => $v){
                    if ($k != 'password') $_SESSION['user'][$k] = $v;
                }
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();

        }
        $this->setMeta('Изенение личных данных пользователя');
    }

    public function ordersAction(){
        if(!User::checkAuth()) redirect('/user/login');
        $orders = R::findAll('order', 'user_id = ?', [$_SESSION['user']['id']]);
        $this->setMeta('История заказов');
        $this->set(compact('orders'));
    }
}