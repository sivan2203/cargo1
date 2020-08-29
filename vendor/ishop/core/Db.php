<?php


namespace ishop;

use \RedBeanPHP as R;


class Db
{
    use TSingletone;

    protected function __construct()
    {
        $db = require_once CONF . '/config_db.php';
        R\R::setup($db['dsn'],$db['user'],$db['pass']);
        if(!R\R::testConnection()){
            throw new \Exception("Нет соединения с БД", 500);
        }

        R\R::freeze(true);

        if(DEBUG){
            R\R::debug(true, 1);
        }

        R\R::ext('xdispense', function ($type){
            return R\R::getRedBean()->dispense($type);
        });

    }

}