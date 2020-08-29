<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Import extends AppModel
{
    public function uploadFile(){
        $uploaddir = WWW . '/upload/';
        //$ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // массив допустимых расширений
//        if($_FILES[$name]['size'] > 1048576){
//            $res = array("error" => "Ошибка! Максимальный вес файла - 1 Мб!");
//            exit(json_encode($res));
//        }
        if($_FILES['data']['error']){
            $this->getErrors();
        }
        if(!in_array($_FILES['data']['type'], $types)){
            $this->getErrors();
        }
        $new_name = 'data.xlsx';
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES['data']['tmp_name'], $uploadfile)){
            return $uploadfile;
        }
    }

    public function importToTbl($from, $to, $data, $help1, $help2){

        if($from && $to && $data && $help1 && $help2){
            $rows = count($data);
            $res = [];

            if(count($from) == $rows && count($to) == $rows){
                for($i = 0; $i < $rows; $i++){
                    //$sql = $from[$i] . ',' . $to[$i] . ',' . $data[$i];
                    if (R::exec("INSERT INTO `databaza` (`id`, `tfrom`, `tto`, `tstr`, `company`, `transport`) 
                    VALUES (NULL, '$from[$i]', '$to[$i]', '$data[$i]', '$help1[$i]', '$help2[$i]')")) $res[] = 1;
                }
            }

            if ($rows == count($res)) return true;
        }

        return false;
    }

    public function importHelper($var, $tbl){
        R::exec('INSERT INTO ' . $tbl . ' (name) VALUE (?)', [$var]);
        $id = R::getInsertID();
        if ($tbl == 'company') R::exec('UPDATE company SET `countShips` = `countShips` + 1 WHERE id = ?', [$id]);
        return $id;
    }

    public function checkInTbl($var, $tbl){
        $res = R::getRow("SELECT * FROM $tbl WHERE name = ?", [$var]);
        if (count($res)){
            R::exec('UPDATE company SET `countShips` = `countShips` + 1 WHERE id = ?', [$res['id']]);
            return $res['id'];
        } else return false;
    }

    public function cleanTbl($tbl){
        if (R::wipe($tbl)) return true;
    }

}