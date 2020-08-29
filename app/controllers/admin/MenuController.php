<?php


namespace app\controllers\admin;


use app\models\admin\Menu;
use RedBeanPHP\R;

class MenuController extends AppController
{
    public function indexAction(){
        //$menu = R::getAssoc('SELECT * FROM menu');
        $menu = R::findAll('menu');
        $this->setMeta('Верхнее меню');
        $this->set(compact('menu'));
    }

    public function addAction(){
        $count_menu = R::count('menu');
        if ($_POST){
            if ($count_menu >= 5){
                $_SESSION['error'] = 'Не можем добавить больше 5 пунктов меню!';
                redirect();
            }
            $data = $_POST;
            $menu = new Menu();
            $menu->load($data);
            if (!$menu->save('menu')){
                $_SESSION['error'] = 'Не получилось добавить новый пункт меню!';
                redirect();
            }
            $_SESSION['success'] = 'Новый пункт добавлен!';
        }
        $this->set(compact('count_menu'));

    }

    public function editAction(){
        if ($_POST){
            $data = [];
            foreach ($_POST as $k => $v){
                $menu = explode('_', $k);
                $data[$menu[1]][$menu[0]] = $v;
                //isset($data[$menu[1]]) ? $data[$menu[1]] .= $v .',' : $data[$menu[1]] = $v;
            }
            $menu = new Menu();
            foreach ($data as $menu_id => $value){
                $menu->load($value);
                //debug($menu,true);
                if(!$menu->update('menu',$menu_id)){
                    $_SESSION['error'] = "К сожалению обновить меню не получилось!";
                    redirect();
                }
            }
            $_SESSION['success'] = 'Изменения сохранены!';
            redirect();
        }
    }

    public function deleteAction(){
        if ($this->getRequestID()){
            $id = $this->getRequestID();
            $menu = R::load('menu', $id);
            R::trash($menu);
            $_SESSION['success'] = 'Страница удалёна!';
            redirect();
        }
    }


}