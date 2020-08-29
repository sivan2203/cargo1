<?php


namespace app\controllers\admin;


use app\models\admin\Import;
use ishop\App;
use ishop\Chunk;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; // alternative reader for special format xlsx
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends AppController
{
    public function indexAction(){

        if (!empty($_FILES)){

            /*Array
            (
                [data] => Array (
                    [name] => import.xlsx
                    [type] => application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
                    [tmp_name] => /opt/lampp/temp/phppafHXH
                    [error] => 0
                    [size] => 9293
                )
            )*/

            $import = new Import();

            if (isset($_POST['flag']) && $_POST['flag'] == 1){
                if (!$import->cleanTbl('databaza')){
                    $_SESSION['error'] = 'Не могу отчистить таблицу с данными перевозок!';
                }
                if (!$import->cleanTbl('company')){
                    $_SESSION['error'] = 'Не могу отчистить таблицу с данными компаний!';
                }
                if (!$import->cleanTbl('transport')){
                    $_SESSION['error'] = 'Не могу отчистить таблицу с данными видов перевозок!';
                }
            }

            if ($file = $import->uploadFile()){

                // Create a new Reader of the type defined in $inputFileType
                $reader = IOFactory::createReader('Xlsx');

                // Define how many rows we want to read for each "chunk"
                $chunkSize = 1000;
                // Create a new Instance of our Read Filter
                $chunkFilter = new Chunk();

                // Tell the Reader that we want to use the Read Filter that we've Instantiated
                $reader->setReadFilter($chunkFilter);
                // Loop to read our worksheet in "chunk size" blocks
                for ($startRow = 1; $startRow <= $chunkSize; $startRow += $chunkSize) {
                    $from = []; //where from
                    $to = []; //where to
                    $data = []; //str with all data
                    $company = []; // array company id
                    $transport = []; // array means of transport

                    // Tell the Read Filter, the limits on which rows we want to read this iteration
                    $chunkFilter->setRows($startRow, $chunkSize);

                    // Load only the rows that match our filter from $inputFileName to a PhpSpreadsheet Object
                    $spreadsheet = $reader->load($file);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, null, null, true);

                    foreach ($sheetData as $k => $v) {
                        if (!empty($v['A'])) { //($k >= 7 && !empty($v['A'])) start with 7 elm and column not empty
                            unset($v['ACU']); // delete last elm array
                            $from[] = $v['C'];
                            $to[] = $v['D'];

                            // check if is company return id, else insert new company
                            $companyCheck = $import->checkInTbl($v['B'], 'company');
                            if (!$companyCheck){
                                $company[] = $import->importHelper($v['B'], 'company');
                            }else{
                                $company[] = $companyCheck;
                            }

                            // check if is transport return id, else insert new transport
                            $transportCheck = $import->checkInTbl(mb_strtolower($v['E']), 'transport');
                            if (!$transportCheck){
                                $transport[] = $import->importHelper(mb_strtolower($v['E']), 'transport');
                            }else{
                                $transport[] = $transportCheck;
                            }

                            $data[] = implode('&', $v);
                        }

                    }

                    if($import->importToTbl($from, $to, $data, $company, $transport)){
                        //insert data and delete vars and clear memory
                        unset($from, $to, $data, $company, $transport);
                        if (file_exists(CACHE)) {
                            foreach (glob(CACHE . '/*') as $file) {
                                unlink($file);
                            }
                        }

                    }else{
                        $_SESSION['error'] = 'Файл не загружен!';
                    }

                }

                $_SESSION['success'] = 'Файл загружен в базу!';

                unlink($file);

            }else{
                $_SESSION['error'] = 'Загрузка файла в базу не прошла! Может Вы не выбрали файл?';
            }
        }

        $this->setMeta('Импорт данных');
    }

}