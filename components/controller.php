<?php

include(ROOT.'/models/Data.php');

class Controller {

    public function Run($connect) {


        $mindate = $_REQUEST['date1'];
        $maxdate = $_REQUEST['date2'];
        $kod = $_REQUEST['obsnametab'];
        $savedata = $_REQUEST['savedata'];


        $errors = Data::Validation($mindate, $maxdate);
        if ($errors) {
           foreach ($errors as $error);
                echo $error;
        }
        $output_table = Data::getData($mindate, $maxdate, $kod, $connect, $savedata);

        Data::Output($output_table, $savedata, $kod);
    }

}