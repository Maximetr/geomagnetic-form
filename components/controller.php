<?php

include(ROOT.'/models/Data.php');

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

}