<?php


namespace app\widgets\topMenu;

use RedBeanPHP\R;

class topMenu
{
    public function __construct()
    {
        $menu = R::getAll('SELECT * FROM menu ORDER BY sort');
        require  __DIR__ . '/topMenu_tpl/topMenu.php';;
    }

}