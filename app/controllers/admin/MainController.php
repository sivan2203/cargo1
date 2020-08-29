<?php


namespace app\controllers\admin;

use RedBeanPHP\R;

class MainController extends AppController
{
    public function indexAction(){

        $countUsers = R::count('user');
        $countPage = R::count('page');
        $countNotes = R::count('databaza');
        $countCompany = R::count('company');

        $this->set(compact('countNotes','countUsers', 'countPage', 'countCompany'));
        $this->setMeta('Панель управления');

    }

}