<?php

namespace app\controllers;

use app\models\Databaza;
use ishop\App;
use ishop\Cach;
use RedBeanPHP\R;

class MainController extends AppController
{
    public $massa = '';
    public $volume = '';
    public $vm = '';

    public function indexAction(){
        if ($_POST){

            // get cities
            $from = (!empty($_POST['from'])) ? h($_POST['from']) : $this->errors[] = 'Поле "Откуда" не может быть пустым!';
            $to = (!empty($_POST['to'])) ? h($_POST['to']) : $this->errors[] = 'Поле "Куда" не может быть пустым!';
            // get logistic
            $wfrom = (int) $_POST['where_from'];
            $wto = (int) $_POST['to_where'];
            // get cargo params
            $this->massa = (float) str_replace(',', '.', $_POST['massa']);
            if (!$this->massa) $this->errors[] = 'Масса груза не может быть меньше или равен 0';
            $this->volume = (float) str_replace(',', '.', $_POST['volume']);
            if (!$this->volume) $this->errors[] = 'Объем груза не может быть меньше или равен 0';

            //check post, if errors redirect
            if ($this->errors){
                foreach ($this->errors as $error){
                    $_SESSION['errors'][] = $error;
                }
                redirect();
            }

            $databaza = new Databaza();
            $data = $databaza->getData($from, $to);
            if(!$data){
                $_SESSION['errors'] = 'К сожалению, мы не нашли перевозок по этому направлению в базе!';
                redirect();
            }

            $data = $this->progressData($data);

            $i = 0;
            foreach ($data as $res) {

                switch (trim((int) $res['L'])){
                    case 1: $data[$i]['price'] = $this->logic1($res);
                    break;
                    case 2: $data[$i]['price'] = $this->logic2($res);
                    break;
                    case 3: $data[$i]['price'] = $this->logic3($res);
                    break;
                    case 4: $data[$i]['price'] = $this->logic4($res);
                    break;
                }

                if ($wfrom || $wto){

//                    [V] => Терминал-Терминал
//                    [W] => Дверь-Терминал
//                    [X] => Терминал-Дверь
//                    [Y] => Дверь-Дверь

                    if($wfrom && !$wto){

                        $data[$i]['basis'] = 'Дверь-Терминал';
                        $data[$i]['price'] = 'По запросу';
                        if ($res['W'] != 'Дверь-Терминал') unset($data[$i]);

                    }elseif(!$wfrom && $wto){

                        $data[$i]['basis'] = 'Терминал-Дверь';
                        $data[$i]['price'] = 'По запросу';
                        if ($res['X'] != 'Терминал-Дверь') unset($data[$i]);

                    }elseif($wfrom && $wto){

                        $data[$i]['basis'] = 'Дверь-Дверь';
                        $data[$i]['price'] = 'По запросу';
                        if ($res['Y'] != 'Дверь-Дверь') unset($data[$i]);

                    }

//                    if ($wfrom && $res['cost_delivery_from']){
//                        $data[$i]['price'] += $res['cost_delivery_from'];
//                    }
//                    if($wto && $res['cost_delivery_to']){
//                        $data[$i]['price'] += $res['cost_delivery_to'];
//                    }
//
//                    if (!$res['cost_delivery_from'] || !$res['cost_delivery_to']){
//                        //unset($data[$i]); //временно оставляем все перевозки по данному направлению, только пеняет стоимость на «По запросу».
//                        $data[$i]['price'] = 'По запросу';
//                    }
                }else{

                    //if ($res['V'] != 'Терминал-Терминал') unset($data[$i]);
                    $data[$i]['basis'] = $res['V'];
                }

                $i++;
            }
            
            $result = array();

            if (!count($data)){
                $result['not_found'] = 'Перевозок с данными параметрами не найдено';
                $result['count'] = $i;
            }

            //$data = $this->array_sort($data, 'price');

            $result = $this->sort_priority($data);
            //debug($data1, true);

            $paramQuery = ['massa' => $this->massa, 'volume' => $this->volume, 'wfrom' => $wfrom, 'wto' => $wto];

            $this->set(compact('from', 'to', 'paramQuery', 'result'));
        }else{
            $company = R::count('company');
            $ships = R::count('databaza');
            $this->set(compact('company', 'ships'));
        }

        $this->setMeta("", "Описание главной страницы", "страница, главная");
    }

    //live column 'tfrom' search
    public function tfromAction(){
        if ($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            $databaza = new Databaza();
            $cities = $databaza->liveSearch('tfrom', $query);
            echo json_encode($cities);
        }
        die;
    }

    //live column 'tto' search
    public function ttoAction(){
        if ($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            $databaza = new Databaza();
            $cities = $databaza->liveSearch('tto', $query);
            echo json_encode($cities);
        }
        die;
    }

    private function progressData($data){
        $updateData = [];
        foreach ($data as $row){
            $updateData[] = $this->destructRow($row);
        }
        $i = 0;
        foreach ($updateData as $item){
            if (isset($item['price_massa'])){
                $updateData[$i]['price_massa'] = $this->getPrice('filter_massa', $item['price_massa'], $this->massa);
            }
            if (isset($item['price_volume'])){
                $updateData[$i]['price_volume'] = $this->getPrice('filter_volume', $item['price_volume'], $this->volume);
            }
            if (isset($item['min_massa'])){
                $updateData[$i]['min_massa'] = $this->getPrice('filter_massa', $item['min_massa'], $this->massa, 1);
            }
            if (isset($item['min_volume'])){
                $updateData[$i]['min_volume'] = $this->getPrice('filter_volume', $item['min_volume'], $this->volume, 1);
            }
            if (isset($item['cost_delivery_from_massa'])){
                $updateData[$i]['cost_delivery_from_massa'] = $this->getPrice('filter_massa', $item['cost_delivery_from_massa'], $this->massa);
            }
            if (isset($item['cost_delivery_from_volume'])){
                $updateData[$i]['cost_delivery_from_volume'] = $this->getPrice('filter_volume', $item['cost_delivery_from_volume'], $this->volume);
            }
            if (isset($item['cost_delivery_to_massa'])){
                $updateData[$i]['cost_delivery_to_massa'] = $this->getPrice('filter_massa', $item['cost_delivery_to_massa'], $this->massa);
            }
            if (isset($item['cost_delivery_to_volume'])){
                $updateData[$i]['cost_delivery_to_volume'] = $this->getPrice('filter_volume', $item['cost_delivery_to_volume'], $this->volume);
            }

            $i++;
        }
        $i = 0;
        foreach ($updateData as $item){
            if ($item['cost_delivery_from_massa'] || $item['cost_delivery_from_volume']){
                $updateData[$i]['cost_delivery_from'] = max($item['cost_delivery_from_massa'], $item['cost_delivery_from_volume']);
            }else{
                $updateData[$i]['cost_delivery_from'] = 0;
            }

            if ($item['cost_delivery_to_massa'] || $item['cost_delivery_to_volume']){
                $updateData[$i]['cost_delivery_to'] = max($item['cost_delivery_to_massa'], $item['cost_delivery_to_volume']);
            }else{
                $updateData[$i]['cost_delivery_to'] = 0;
            }

            unset($updateData[$i]['cost_delivery_from_massa'], $updateData[$i]['cost_delivery_from_volume'],
                $updateData[$i]['cost_delivery_to_massa'], $updateData[$i]['cost_delivery_to_volume']);

            $i++;
        }

        return $updateData;
    }
    
    private function destructRow($row){
        $row['price_massa'] = [];
        $row['price_volume'] = [];
        $row['min_massa'] = [];
        $row['min_volume'] = [];
        $row['add_costs_from'] = [];
        $row['add_costs_to'] = [];
        $row['cost_delivery_from_massa'] = [];
        $row['cost_delivery_from_volume'] = [];
        $row['cost_delivery_to_massa'] = [];
        $row['cost_delivery_to_volume'] = [];
        $row['cost_delivery_from'] = '';
        $row['cost_delivery_to'] = '';

        $i = 1;
        foreach ($row as $key => $item) {
            //price by massa (from 26 to 156)
            if ((26 <= $i) && ($i <= 156)){
                $row['price_massa'][] = (float) $item;
                unset($row[$key]);
            }
            //price by volume (from 157 to 248)
            if ((157 <= $i) && ($i <= 248)){
                $row['price_volume'][] = (float) $item;
                unset($row[$key]);
            }
            //min by massa (from 250 to 272)
            if ((250 <= $i) && ($i <= 272)){
                $row['min_massa'][] = (float) $item;
                unset($row[$key]);
            }
            //min by volume (from 273 to 291)
            if ((273 <= $i) && ($i <= 291)){
                $row['min_volume'][] = (float) $item;
                unset($row[$key]);
            }
            //add costs place of shipment (from 296 to 310)
            if ((296 <= $i) && ($i <= 310)){
                $row['add_costs_from'][] = (float) $item;
                unset($row[$key]);
            }
            //add costs place of receipt (from 311 to 325)
            if ((311 <= $i) && ($i <= 325)){
                $row['add_costs_to'][] = (float) $item;
                unset($row[$key]);
            }
            //costs delivery to shipment massa (from door) (from 326 to 456)
            if ((326 <= $i) && ($i <= 456)){
                $row['cost_delivery_from_massa'][] = (float) $item;
                unset($row[$key]);
            }
            //costs delivery to shipment volume (from door) (from 457 to 548)
            if ((457 <= $i) && ($i <= 548)){
                $row['cost_delivery_from_volume'][] = (float) $item;
                unset($row[$key]);
            }
            //costs delivery from receipt massa (to door) (from 549 to 679)
            if ((549 <= $i) && ($i <= 679)){
                $row['cost_delivery_to_massa'][] = (float) $item;
                unset($row[$key]);
            }
            //costs delivery from receipt volume (to door) (from 680 to 771)
            if ((680 <= $i) && ($i <= 771)){
                $row['cost_delivery_to_volume'][] = (float) $item;
                unset($row[$key]);
            }
            $i++;
        }

        return $row;
    }

    private function getPrice($filter, $dataPriceMassa, $val, $min = 0){
        if ($min){
            if ($filter == 'filter_massa') $int = 22;
            elseif($filter == 'filter_volume') $int = 18;
        }

        $i = 0;

        $filter = App::$app->getProperty($filter);
        $count_filter = count($filter);
        foreach ($filter as $key => $item) {
            $helper = explode('-', $item);
            if (($helper[0] <= $val) && ($val < $helper[1])){
                return $dataPriceMassa[$key];
                break;
            }
//            else{
//                unset($dataPriceMassa[$key]);
//            }
            if(isset($int) && $int < $i) break;
            if ($i == $count_filter -1) return $dataPriceMassa[$key];
            $i++;
        }
    }

    private function logic1($data){

        $res  = max(
            $this->formula1($data),
            $this->formula2($data),
            $this->formula3($data),
            $this->formula4($data),
            $this->formula5($data),
            $this->formula6($data));

        if (!$res) return 'По запросу';
        else return $res;
    }

    private function logic2($data){
        $this->vm = $this->volume * (int) $data['M'];

        $res  = max(
            $this->formula1($data),
            $this->formula7($data),
            $this->formula3($data),
            $this->formula8($data),
            $this->formula5($data),
            $this->formula9($data));

        if (!$res) return 'По запросу';
        else return $res;
    }

    private function logic3($data){
        $kmv = $this->massa / $this->volume;
        $factor = $data['P'] * 1000;

        if ($kmv >= $factor){
            $res  = max(
                $this->formula1($data),
                $this->formula3($data),
                $this->formula5($data));
        }elseif($kmv < $factor){
            $res  = max(
                $this->formula2($data),
                $this->formula4($data),
                $this->formula6($data));
        }

        if (!$res) return 'По запросу';
        else return $res;
    }

    private function logic4($data){
        $kmv = $this->massa / $this->volume;
        if ($kmv > $data['N'] && $kmv <= $data['O'] ){
            $pm = $this->formula1($data); // ЦМ
            $pv = $this->formula2($data); // ЦV

            if ($pm){
                $res = max(
                    $pm,
                    $this->formula3($data), // ЦМmin∑
                    $this->formula5($data) // ЦМminМ
                );
            } elseif($pv){
                $res = max(
                    $pv,
                    $this->formula4($data), // ЦVmin∑
                    $this->formula6($data) // ЦVminV
                );
            }

        }else{
            $res = 0;
        }

        if (!$res) return 'По запросу';
        else return $res;
    }

    private function formula1($data){
        $res = $this->massa * (float) $data['price_massa'] * (float) $data['Q'] + $this->massa * ((float) $data['KF'] + (float) $data['KH'])
            + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
        return $res;
    }

    private function formula2($data){
        $res = $this->volume * (float) $data['price_volume'] * (float) $data['R'] + $this->volume * ((float) $data['KG'] + (float) $data['KI'])
            + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
        return $res;
    }

    private function formula3($data){
        $res = (float) $data['IO'] + $this->massa * ((float) $data['KF'] + (float) $data['KH']) + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
        return $res;
    }

    private function formula4($data){
        $res = (float) $data['IO'] + $this->volume * ((float) $data['KF'] + (float) $data['KH']) + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
        return $res;
    }

    private function formula5($data){
        if ($this->massa > 100){
            return false;
        } else {
            $res = (float) $data['min_massa'] + $this->massa * ((float) $data['KF'] + (float) $data['KH']) + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
            return $res;
        }
    }

    private function formula6($data){
        if ($this->volume > 1){
            return false;
        } else {
            $res = (float) $data['min_volume'] + $this->massa * ((float) $data['KG'] + (float) $data['KI']) + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
            return $res;
        }
    }

    private function formula7($data){
        $res = $this->vm * (float) $data['price_massa'] * (float) $data['R'] + $this->vm * ((float) $data['KF'] + (float) $data['KH'])
            + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
        return $res;
    }

    private function formula8($data){
        $res = (float) $data['IO'] + $this->vm * ((float) $data['KF'] + (float) $data['KH']) + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
        return $res;
    }

    private function formula9($data){
        if ($this->vm > 100){
            return false;
        } else {
            $res = (float) $data['min_massa'] + $this->vm * ((float) $data['KF'] + (float) $data['KH']) + array_sum($data['add_costs_from']) + array_sum($data['add_costs_to']);
            return $res;
        }
    }

    private function sort_priority($data){
        $entry_arr = array();
        $output_arr = array();
        foreach ($data as $v){
            $v['G'] = (int) $v['G'];
            $entry_arr[$v['G']][] = $v;
        }

        foreach ($entry_arr as $k => $v){
            $output_arr[$k] = $this->array_sort($v, 'price');
        }

        ksort($output_arr);
        $output_arr[] = $output_arr[0];
        unset($output_arr[0]);
        return $output_arr;
    }

    private function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            //completion first numbers then strings
            foreach ($sortable_array as $k => $v) {
                if(!is_string($v)) $new_array[$k] = $array[$k];
            }

            foreach ($sortable_array as $k => $v) {
                if(is_string($v)) $new_array[$k] = $array[$k];
            }

        }

        return $new_array;
    }

}