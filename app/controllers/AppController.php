<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use ishop\App;
use ishop\base\Controller;
use ishop\Cach;
use RedBeanPHP\R;

class AppController extends Controller
{
    public $errors = [];

    public function __construct($route)
    {
        parent::__construct($route);
        if (isset($_SESSION['user']['role']) != 'admin' && App::$app->getProperty('serv')){
            include_once 'serv.php';
            exit();
        }
        new AppModel();
        //App::$app->setProperty('currencies', Currency::getCurrencies());
        //App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currencies')));
        //App::$app->setProperty('cats', self::cacheCategory());
    }

    public static function cacheCategory(){
        $cache = Cach::instance();
        $cats = $cache->get('cats');
        if (!$cats){
            $cats = R::getAssoc("SELECT * FROM category");
            $cache->set('cats',$cats);
        }
        return $cats;
    }

}