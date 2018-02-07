<?php

class User {
    public static function Validation($mindate, $maxdate) {
        $errors = array();

        

        if ($maxdate < $mindate) {
            $errors[] = 'Неверно введена дата';
        }

        return $errors;
    }

    public static function getData($mindate, $maxdate, $kod, $connect) {

        $start_table = array();

        $query = mysqli_query($connect, ("SELECT * FROM hourdata WHERE Kod ='$kod' AND Date>='$mindate' AND Date<='$maxdate'"));

        while ($result = mysqli_fetch_array($query, MYSQLI_NUM)) {
            $start_table[] = $result;
        }

        $table = self::Make_WDC_format($start_table);
        return $table;
        
    }

    public static function Make_WDC_format($table) {
        
    }
