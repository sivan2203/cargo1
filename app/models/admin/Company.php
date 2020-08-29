<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;

class Company extends AppModel
{

    public function getAllCompany($start, $perpage){ //with php pagination
        $company = R::getAll("SELECT * FROM company ORDER BY 'name' DESC LIMIT $start, $perpage");
//        $i = 0;
//        foreach ($company as $firm){
//            $company[$i]['countShips'] = $this->countShip($firm['id']);
//            $i++;
//        }
        return $company;
    }

    public function getAllCompany1(){
        $company = R::getAll("SELECT * FROM company ORDER BY 'name' DESC");
        return $company;
    }


    public function getCompany($id){
        if ($id) return R::getRow("SELECT * FROM company WHERE id = ?", [$id]);
        else return false;
    }

    private function countShip($id){
        //$countShip = R::getAll('SELECT id, transport FROM databaza WHERE company = ?', [$id]);
        $countShip = R::count('databaza', 'WHERE company = ?', [$id]);
        //R::exec("UPDATE company SET countShips = $countShip WHERE id = $id");
        return $countShip;
    }

    public function getTransportCompany($company_id){
        if ($company_id){
            $transportCompany = $this->getAllTransport();
            if ($transportCompany){
                $i = 0;
                foreach ($transportCompany as $k=>$v) {
                    $count = R::count('databaza', 'WHERE company = ? AND transport = ?', [$company_id, $v['id']]);
                    if($count) $transportCompany[$i]['count'] = $count;
                    else unset($transportCompany[$i]);
                    $i++;
                }
               return $transportCompany;
            }
        }
    }

    public function getAllTransport(){
        $transport = R::getAll("SELECT * FROM transport");
        if (count($transport) > 0){
            return $transport;
        } else {
            return false;
        }
    }

}