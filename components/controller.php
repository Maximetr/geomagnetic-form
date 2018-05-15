<?php

include(ROOT.'/models/Data.php');
include(ROOT.'/models/InsertData.php');

class Controller {

    public function Run($connect) {


        $mindate = $_POST['date1'];
        $maxdate = $_POST['date2'];
        $kod = $_POST['obsnametab'];
        $savedata = $_POST['savedata'];
        $email = $_POST['email'];


        $errors = Data::Validation($mindate, $maxdate);
        if ($errors) {
           foreach ($errors as $error);
                echo $error;
        }
        $output_table = Data::getData($mindate, $maxdate, $kod, $connect, $savedata, $email);

        Data::Output($output_table, $savedata, $kod);
    }


    public function StartInsert() {
        $inputData = $_POST['inputData'];
        $file = ROOT."/minutedata/inputfile.txt";
        file_put_contents($file, $inputData);

        echo 'Проверяю данные';
        $checkResult = InsertData::Check($file);
        if ($checkResult == true) {
            echo 'Данные введены корректно, начинаю загрузку в базу данных';
            
        }

        
    }

}