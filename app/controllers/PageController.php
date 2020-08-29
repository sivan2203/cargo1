<?php


namespace app\controllers;


use ishop\App;
use RedBeanPHP\R;

class PageController extends AppController
{
    public function viewAction(){
        $alias = $this->route['alias'];
        $page = R::findOne('page', 'alias = ?', [$alias]);
        if(!$page){
            throw new \Exception('Страница не найдена', 404);
        }

        $title = $page->title;
        $text = $page->text;

        //$hits = R::find('product', "hit = '1' AND status = '1' LIMIT 3");
        //$curr = App::$app->getProperty('currency');

        $this->setMeta($page->title, $page->description, $page->keyw);
        $this->set(compact('text', 'title'));
    }

}