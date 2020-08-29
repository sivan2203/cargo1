<?php


namespace app\widgets\diagram;


use ishop\Cach;
use RedBeanPHP\R;

class Diagram
{
    public function __construct()
    {
        $cach = Cach::instance();
        if ($cach->get('allcompany')){
            $allcompany = $cach->get('allcompany');
        }else{
            $allcompany = R::getAll("SELECT * FROM company");

            $i = 0;
            foreach ($allcompany as $firm){
                $allcompany[$i]['countShip'] = $this->countShip($firm['id']);
                $i++;
            }

            $cach->set('allcompany', $allcompany);

        }

        require __DIR__ . '/diagram_tpl/diagram.php';
    }

    private function countShip($id){
        //$countShip = R::getAll('SELECT id, transport FROM databaza WHERE company = ?', [$id]);
        $countShip = R::count('databaza', 'WHERE company = ?', [$id]);
        return $countShip;
    }

}