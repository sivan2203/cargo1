<?php


namespace app\controllers\admin;


use ishop\Cach;

class CacheController extends AppController
{
    public function indexAction(){
        if (file_exists(CACHE)) {
            foreach (glob(CACHE . '/*') as $file) {
                unlink($file);
            }
            $_SESSION['success'] = "Файлы кэша удалены!";
            redirect();
        }
    }

    public function deleteAction(){
        if ($_GET['key']){
            $key = $_GET['key'];
            $cache = Cach::instance();
            switch ($key){
                case 'category':
                    $cache->delete('cats');
                    $cache->delete('ishop_menu');
                    $key = 'категорий';
                    break;
                case 'filter':
                    $cache->delete('filter_group');
                    $cache->delete('filter_attrs');
                    $key = 'фильтров товара';
                    break;
                case 'all':
                    $cache->delete('cats');
                    $cache->delete('ishop_menu');
                    $cache->delete('filter_group');
                    $cache->delete('filter_attrs');
                    $key = 'полностью';
                    break;
            }
            $_SESSION['success'] = "Кэш $key удален!";
            redirect();
        }else{
            throw new \Exception('Страница не найдена!', 404);
        }
    }

}