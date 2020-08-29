<?php


namespace app\controllers\admin;


use app\models\admin\Company;
use ishop\Cach;
use ishop\libs\Pagination;
use RedBeanPHP\R;

class CompanyController extends AppController
{
    //public $perpage = 50;

    public function indexAction(){
//        $page = isset($_GET['page']) ? $_GET['page'] : 1;
//        $count = R::count('company');
//        $pagination = new Pagination($page, $this->perpage, $count);
//        $start = $pagination->getStart();

        $cache = Cach::instance();
        if (!$cache->get('company' . $page)){
            $modelCompany = new Company();
            $company = $modelCompany->getAllCompany1();
            $cache->set('company' . $page, $company);
        }else{
            $company = $cache->get('company' . $page);
        }

        //$this->set(compact('company', 'pagination', 'count')); //with php pagination
        $this->set(compact('company'));

        $this->setMeta('Панель управления');

    }

    public function editAction(){
        $company_id = $this->getRequestID();
        $company = new Company();
        $companyData = $company->getCompany($company_id);
        $cash = Cach::instance();
        if (!$cash->get('transport' . $company_id)){
            $transport = $company->getTransportCompany($company_id);
            $cash->set('transport' . $company_id, $transport);
        }else{
            $transport = $cash->get('transport' . $company_id);
        }

        $this->set(compact('companyData', 'transport'));
        $this->setMeta('Все виды перевозок ' . $companyData['name']);
    }

    public function deleteAction(){
        $id = $this->getRequestID();
        $count = R::count('company');
        $pages = ceil($count / $this->perpage);
        $cash = Cach::instance();
        for ($i = 1; $i <= $pages; $i++){
            $cash->delete('company' . $i);
        }

        if (isset($_GET['transport_id'])){
            $tr_id = $_GET['transport_id'];

            if (R::hunt('databaza','company = ? and transport = ?', [$id, $tr_id])){
                if (!R::count('databaza', 'company = ?', [$id])){
                    R::hunt('company','id = ?', [$id]);
                    $_SESSION['success'] = 'Перевозки удалены!';
                    redirect('/admin/company/');
                }else{
                    $cash->delete('transport' . $id);
                    $_SESSION['success'] = 'Перевозки удалены!';
                    redirect();
                }
            }
            $_SESSION['error'] = 'Перевозки удалить не получилось!';
            redirect();
        }else{
            if (R::hunt('databaza','company = ?', [$id])){
                if (R::hunt('company','id = ?', [$id])){
                    $_SESSION['success'] = 'Компания удалена!';
                    redirect();
                }
                $_SESSION['error'] = 'Не удалось удалить компанию!';
                redirect();
            }
            $_SESSION['error'] = 'У этой компании нет перевозок для удаления!';
            redirect();
        }

    }

}