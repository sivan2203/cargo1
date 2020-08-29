<?php


namespace app\controllers;

use app\models\admin\Company;
use ishop\Cach;
use ishop\libs\Pagination;
use RedBeanPHP\R;

class CompanyController extends AppController
{
    public function indexAction(){
//        $page = isset($_GET['page']) ? $_GET['page'] : 1;
//        $perpage = 25;
//        $count = R::count('company');
//        $pagination = new Pagination($page, $perpage, $count);
//        $start = $pagination->getStart();
//
//        $cache = Cach::instance();
//        if (!$cache->get('fcompany' . $page)){
//            $modelCompany = new Company();
//            $company = $modelCompany->getAllCompany($start, $perpage);
//            $cache->set('fcompany' . $page, $company);
//        }else{
//            $company = $cache->get('fcompany' . $page);
//        }

        $this->set(compact('company', 'pagination', 'count'));
        $this->setMeta('Список компаний');

    }
}