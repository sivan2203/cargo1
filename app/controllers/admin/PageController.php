<?php


namespace app\controllers\admin;

use app\models\admin\Page;
use ishop\libs\Pagination;
use app\models\AppModel;
use RedBeanPHP\R;

class PageController extends AppController
{
    public function indexAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 15;
        $count = R::count('page');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $pages = R::find('page', "LIMIT $start, $perpage");
        $this->setMeta('Список страниц');
        $this->set(compact('pages', 'pagination', 'count'));
    }

    public function addAction(){
        if(!empty($_POST)) {
            $page = new Page();
            $data = $_POST;
            $page->load($data);
            if ($id = $page->save('page')) {
                $alias = AppModel::createAlias('page', 'alias', $data['title'], $id);
                $p = R::load('page', $id);
                $p->alias = $alias;
                R::store($p);
                $_SESSION['success'] = 'Страница добавлена';
            }
            redirect();
        }
        $this->setMeta('Новая страница');
    }

    public function editAction (){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $page = new Page();
            $data = $_POST;
            $page->load($data);

            if(!$page->validate($data)){
                $page->getErrors();
                redirect();
            }

            if($page->update('page',$id)){
                $alias = AppModel::createAlias('page','alias', $data['title'], $id);
                $page = R::load('page',$id);
                $page->alias = $alias;
                R::store($page);
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }

        $id = $this->getRequestID();
        $page = R::load('page', $id);
        $this->setMeta("Редактирование страницы {$page->title}");
        $this->set(compact('page'));
    }

    public function deleteAction(){
        if ($this->getRequestID()){
            $id = $this->getRequestID();
            $pg = R::load('page', $id);
            R::trash($pg);
            $_SESSION['success'] = 'Страница удалёна!';
            redirect();
        }
    }

}