<?php


namespace app\models;


use ishop\App;
use RedBeanPHP\R;

class Databaza extends AppModel
{
    public function getData($from, $to){

        $data = [];
        $from = '%' . trim($_POST['from']) . '%';
        $to = '%' . trim($_POST['to']) . '%';

        //SELECT * FROM `databaza` WHERE `tfrom` LIKE '%Москва%' AND `tto` LIKE '%Санкт-Петербург%'
        $res = R::getAll("SELECT tstr FROM databaza WHERE tfrom LIKE ? AND tto LIKE ?", [$from, $to]);
        $key = explode('&', App::$app->getProperty('key'));
        foreach($res as $k => $v){
            $v = explode('&', $v['tstr']);
            $data[] = array_combine($key, $v);
        }

        if(count($data) == '0') return false;
        else return $data;
    }

    public function liveSearch($column, $query){
        if ($query){
            $res = R::getAll("SELECT $column FROM databaza WHERE $column LIKE ?", ["%{$query}%"]);
            $cities = [];
            foreach ($res as $r){
                if (!in_array($r, $cities)) $cities[] = $r;
            }
            return $cities;
        }
    }
}