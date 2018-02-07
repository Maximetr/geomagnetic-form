<?php

include(ROOT.'/models/User.php');

class Controller {

    public function Run($connect) {


        $mindate = $_REQUEST['date1'];
        $maxdate = $_REQUEST['date2'];
        $kod = $_REQUEST['obsnametab'];


        $errors = User::Validation($mindate, $maxdate);
        if ($errors) {
           foreach ($errors as $error);
                echo $error;
        }   else {
            echo "ok";
            }

        $start_table = User::getData($mindate, $maxdate, $kod, $connect);

        print_r($start_table);
    }

}