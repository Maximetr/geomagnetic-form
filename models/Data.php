<?php

class Data {
    public static function Validation($mindate, $maxdate) {
        $errors = array();

        

        if ($maxdate < $mindate) {
            $errors[] = 'Неверно введена дата';
        }

        return $errors;
    }

    public static function getData($mindate, $maxdate, $kod, $connect, $savedata) {

        $input_table = array();
        if ($savedata == 'IAGA2002') {
            $query = mysqli_query($connect, ("SELECT Kod, Element, Date, Basic, HourSet1,HourSet2,HourSet3,HourSet4,HourSet5,HourSet6,HourSet7,HourSet8,HourSet9,HourSet10,HourSet11,HourSet12,HourSet13,HourSet14,HourSet15,HourSet16,HourSet17,HourSet18,HourSet19,HourSet20,HourSet21,HourSet22,HourSet23,HourSet24
                                FROM hourdata WHERE Kod = '$kod' AND Date >= '$mindate' AND Date <= '$maxdate' ORDER BY Date"));
        } else {
            $query = mysqli_query($connect, ("SELECT * FROM hourdata WHERE Kod ='$kod' AND Date>='$mindate' AND Date<='$maxdate'"));
        }

        while ($result = mysqli_fetch_array($query, MYSQLI_NUM)) {
            $input_table[] = $result;
        }

        if ($savedata == 'WDC') {
            $output_table = self::Make_WDC_format($input_table);
            return $output_table;
        }
        if ($savedata == 'CSV') {
            $output_table = self::Make_CSV_format($input_table);
            return $output_table;
        }
        if ($savedata == 'IAGA2002') {
            $output_table = self::Make_IAGA2002_format($input_table, $kod);
            return $output_table;
        }
        
    }

    public static function Make_WDC_format($input_table) {
        foreach ($input_table as $row) {
            $observkod = $row[0];
            $year = $row[1];
            $month = $row[2];
            $element  = $row[3];
            $day = $row[4];
            $usznk = $row[6];
            $sostdays = $row[7];
            $I = $row[8];
            $basic = $row[9];
            $hoursets = array($row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28],$row[29],$row[30],$row[31],$row[32],$row[33],$row[34]);
            for ($j = 0; $j<=24; $j++) {
            if ($hoursets[$j] <> "9999") {
                $hoursets[$j] = str_pad($hoursets[$j], 4, " ", STR_PAD_LEFT);
                }
            }
            if ($usznk == "99") {
                $usznk = "  ";
            }
            if ($sostdays == "999") {
                $sostdays = " ";
            }
            if ($I == "9") {
                $I = " ";
            }
            if ($day<=9){
                $day = "0$day";
            }
            if ($month<=9){
                $month = "0$month";
            }
            $basic = str_pad($basic, 4, "0", STR_PAD_LEFT);

            $output_row = "$observkod$year$month$element$day  $usznk$sostdays$I$basic$hoursets[0]$hoursets[1]$hoursets[2]$hoursets[3]$hoursets[4]$hoursets[5]$hoursets[6]$hoursets[7]$hoursets[8]$hoursets[9]$hoursets[10]$hoursets[11]$hoursets[12]$hoursets[13]$hoursets[14]$hoursets[15]$hoursets[16]$hoursets[17]$hoursets[18]$hoursets[19]$hoursets[20]$hoursets[21]$hoursets[22]$hoursets[23]$hoursets[24]\n";
            array_shift($input_table);
            $output_table[] = $output_row;
        }

        return $output_table;
    }

    public static function Make_CSV_format($input_table) {
        foreach ($input_table as $row) {
            $observkod = $row[0];
            $year = $row[1];
            $month = $row[2];
            $element  = $row[3];
            $day = $row[4];
            $usznk = $row[6];
            $sostdays = $row[7];
            $I = $row[8];
            $basic = $row[9];
            $hoursets = array($row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28],$row[29],$row[30],$row[31],$row[32],$row[33],$row[34]);
            for ($j = 0; $j<=24; $j++) {
            if ($hoursets[$j] <> "9999") {
                $hoursets[$j] = str_pad($hoursets[$j], 4, " ", STR_PAD_LEFT);
                }
            }
            if ($usznk == "99") {
                $usznk = "  ";
            }
            if ($sostdays == "999") {
                $sostdays = " ";
            }
            if ($I == "9") {
                $I = " ";
            }
            if ($day<=9){
                $day = "0$day";
            }
            if ($month<=9){
                $month = "0$month";
            }
            $basic = str_pad($basic, 4, "0", STR_PAD_LEFT);

            $output_row = "$observkod,$year,$month,$element,$day,  $usznk,$sostdays,$I,$basic,$hoursets[0],$hoursets[1],$hoursets[2],$hoursets[3],$hoursets[4],$hoursets[5],$hoursets[6],$hoursets[7],$hoursets[8],$hoursets[9],$hoursets[10],$hoursets[11],$hoursets[12],$hoursets[13],$hoursets[14],$hoursets[15],$hoursets[16],$hoursets[17],$hoursets[18],$hoursets[19],$hoursets[20],$hoursets[21],$hoursets[22],$hoursets[23],$hoursets[24],\n";
            array_shift($input_table);
            $output_table[] = $output_row;
        }

        return $output_table;
    }

    public static function Make_IAGA2002_format($input_table, $kod) {

        //Функция проверки элементов
        function ElementChek($input_table) {
            $flag = 'XYZF';
                for ($i = 0; $i <=10; $i++) {
                    if  ($input_table[$i][1] == 'D' or $input_table[$i][1] == 'H') {
                        $flag = 'DHZF';
                        break;
                    }
                }
            return $flag;
        }

        //Функция расчета значений для элементов
        function MyCount($element, $basic, $znach) {
            if ($znach == '9999') {
                $value = '99999.00';
            }   elseif ($element == 'D' or $element == 'I') {
                    $value = ($basic * 60) + ($znach / 10);
            }   else { 
                    $value = $basic * 100 + $znach;
                }
            return $value;
        }

        //Функция работы со строкой
        function RowJob($row1, $row2, $row3, $row4) {
            $array = array();
            $date = $row1[2];
            $explode_date = explode('-', $date);
            $doy = date('z', mktime(0,0,0,$explode_date[1], $explode_date[2], $explode_date[0])) +1;
            $hour = 0;
            if ($doy <10) {
                $doy = "00$doy";
            }   elseif ($doy >9 && $doy<100) {
                $doy = "0$doy";
            }   else {
                $doy = "$doy";
            }
            if ($row2[2] == $date && $row3[2] == $date && $row4[2] == $date) {
                for ($i = 4, $j = 0; $i<=27; $i++, $j++) {
                
                    $el1 = MyCount($row1[1], $row1[3], $row1[$i]);
                    $el2 = MyCount($row2[1], $row2[3], $row2[$i]);
                    $el3 = MyCount($row3[1], $row3[3], $row3[$i]);
                    $el4 = MyCount($row4[1], $row4[3], $row4[$i]);
                    $string = "$date $hour:30:00.000 $doy    $el1 $el2 $el3 $el4\n";
                    $array[$j][0] = $date;
                    if ($hour < 10){
                        $array[$j][1] = "0$hour:30.00.000";
                    }   else {
                        $array[$j][1] = "$hour:30.00.000";
                    }
                    $array[$j][2] = $doy;
                    //перестановка первого элемента
                    if ($row1[1] == 'D' or $row1[1] == 'X') {
                        $array[$j][3] = $el1;
                    }   elseif ($row1[1] == 'H' or $row1[1] == 'Y') {
                            $array[$j][4] = $el1;
                    }   elseif ($row1[1] == 'Z'){
                            $array[$j][5] = $el1;
                    }   else {$array[$j][6] = $el4;}
                    //перестановка второго элемента
                    if ($row2[1] == 'D' or $row2[1] == 'X') {
                        $array[$j][3] = $el2;
                    }   elseif ($row2[1] == 'H' or $row2[1] == 'Y') {
                            $array[$j][4] = $el2;
                    }   elseif ($row2[1] == 'Z'){
                            $array[$j][5] = $el2;
                    }else {$array[$j][6] = $el4;}
                    //перестановка третьего элемента
                    if ($row3[1] == 'D' or $row3[1] == 'X') {
                        $array[$j][3] = $el3;
                    }   elseif ($row3[1] == 'H' or $row3[1] == 'Y') {
                            $array[$j][4] = $el3;
                    }   elseif ($row3[1] == 'Z'){
                            $array[$j][5] = $el3;
                    }else {$array[$j][6] = $el4;}
                    //перестановка четвертого элемента
                    if ($row4[1] == 'D' or $row4[1] == 'X') {
                        $array[$j][3] = $el4;
                    }   elseif ($row4[1] == 'H' or $row4[1] == 'Y') {
                            $array[$j][4] = $el4;
                    }   elseif ($row4[1] == 'Z'){
                            $array[$j][5] = $el4;
                    }else {$array[$j][6] = $el4;}
                    $hour++;
                }
            }   elseif ($row1[1] != 'F' && $row2[1] != 'F' && $row3[1] != 'F' && $row4[1] != 'F') {
                    for ($i = 4, $j = 0; $i<=27; $i++, $j++) {
                        $el1 = MyCount($row1[1], $row1[3], $row1[$i]);
                        $el2 = MyCount($row2[1], $row2[3], $row2[$i]);
                        $el3 = MyCount($row3[1], $row3[3], $row3[$i]);
                        //$el4 = MyCount($row4[1], $row4[3], $row4[$i]);
                        $string = "$date $hour:30:00.000 $doy    $el1 $el2 $el3 99999.00\n";
                        
                        $array[$j][0] = $date;
                        if ($hour < 10){
                            $array[$j][1] = "0$hour:30.00.000";
                        }   else {
                            $array[$j][1] = "$hour:30.00.000";
                        }
                        $array[$j][2] = $doy;
                        //перестановка первого элемента
                        if ($row1[1] == 'D' or $row1[1] == 'X') {
                            $array[$j][3] = $el1;
                        }   elseif ($row1[1] == 'H' or $row1[1] == 'Y') {
                                $array[$j][4] = $el1;
                        }   elseif ($row1[1] == 'Z'){
                                $array[$j][5] = $el1;
                        }
                        //перестановка второго элемента
                        if ($row2[1] == 'D' or $row2[1] == 'X') {
                            $array[$j][3] = $el2;
                        }   elseif ($row2[1] == 'H' or $row2[1] == 'Y') {
                                $array[$j][4] = $el2;
                        }   elseif ($row2[1] == 'Z'){
                                $array[$j][5] = $el2;
                        }
                        //перестановка третьего элемента
                        if ($row3[1] == 'D' or $row3[1] == 'X') {
                            $array[$j][3] = $el3;
                        }   elseif ($row3[1] == 'H' or $row3[1] == 'Y') {
                                $array[$j][4] = $el3;
                        }   elseif ($row3[1] == 'Z'){
                                $array[$j][5] = $el3;
                        }
                        $array[$j][6] = '99999.00';
                        $hour++;
                    }
                }
            return $array;
        }

        $elements = ElementChek($input_table);
    
        $end = end($input_table);
        $lastkey = key($input_table);
    
        for ($i=0, $j=0;$i<=$lastkey; $j++) {
            $output_table[$j] = RowJob($input_table[$i], $input_table[$i+1], $input_table[$i+2], $input_table[$i+3]);
            $i = $i+3;
        }

        function output($array, $elements,$kod) {
            if ($elements == 'DHZF') {
                $el11 = 'D';
                $el22 = 'H';
                $el33 = 'Z';
                $el44 = 'F';
            } else {
                $el11 = 'X';
                $el22 = 'Y';
                $el33 = 'Z';
                $el44 = 'F';
            }
        
        echo " Format                  IAGA-2002                                   |
 Source of Data                                                      |
 Station Name                                                        |
 IAGA Code               $kod                                         |
 Geodetic Latitude                                                   |
 Geodetic Longitude                                                  |
 Elevation                                                           |
 Reported                $elements                                        |
 Sensor Orientation                                                  |
 Digital Sampling                                                    |
 Data Interval Type      HOUR                                        |
 Data Type                                                           |
 DATE       TIME         DOY     " . $kod . "$el11      " . $kod . "$el22      " . $kod . "$el33      " . $kod . "$el44  |\n";
            foreach ($array as $level1) {
                foreach ($level1 as $level2) {
                    $date = $level2[0];
                    $time = $level2[1];
                    $doy = $level2[2];
                    $el1 = $level2[3];
                    $el2 = $level2[4];
                    $el3 = $level2[5];
                    $el4 = $level2[6];
                    if (is_int($el1)) {
                        $el1 = "$el1.00";
                    }   elseif (is_float($el1)) {
                        $el1 = "$el1"."0";
                    }
        
                    if (is_int($el2)) {
                        $el2 = "$el2.00";
                    }   elseif (is_float($el2)) {
                        $el2 = "$el2"."0";
                    }
        
                    if (is_int($el3)) {
                        $el3 = "$el3.00";
                    }   elseif (is_float($el3)) {
                        $el3 = "$el3"."0";
                    }
        
                    if (is_int($el4)) {
                        $el4 = "$el4.00";
                    }   elseif (is_float($el4)) {
                        $el4 = "$el4"."0";
                    }
        
                    $el1 = str_pad($el1, 9, " ", STR_PAD_LEFT);
                    $el2 = str_pad($el2, 9, " ", STR_PAD_LEFT);
                    $el3 = str_pad($el3, 9, " ", STR_PAD_LEFT);
                    $el4 = str_pad($el4, 9, " ", STR_PAD_LEFT);
        
                    
                    $string = "$date $time $doy    $el1 $el2 $el3 $el4\n";
                    echo $string;
                }
            }
        }
        $file = output($output_table, $elements, $kod);
        file_put_contents($_SERVER['DOCUMENT_ROOT']. '/file.txt', "$file");
    }

    public static function Output($output_table, $savedata, $kod) {
        if ($savedata == 'WDC' or $savedata == 'CSV') {
            foreach ($output_table as $row) {
                echo $row;
            }
            $file = 'file.txt';
            file_put_contents($file, $output_table);
        }

        return true;

    }
}