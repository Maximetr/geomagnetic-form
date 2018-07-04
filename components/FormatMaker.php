<?php

class FormatMaker
{
    public static function WDCformat($data, $datatype)
    {
        if ($datatype == 'hourly') {
            foreach ($data as $row) {
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
    
                $resultRow = "$observkod$year$month$element$day  $usznk$sostdays$I$basic$hoursets[0]$hoursets[1]$hoursets[2]$hoursets[3]$hoursets[4]$hoursets[5]$hoursets[6]$hoursets[7]$hoursets[8]$hoursets[9]$hoursets[10]$hoursets[11]$hoursets[12]$hoursets[13]$hoursets[14]$hoursets[15]$hoursets[16]$hoursets[17]$hoursets[18]$hoursets[19]$hoursets[20]$hoursets[21]$hoursets[22]$hoursets[23]$hoursets[24]\n";
                array_shift($data);
                $resultData[] = $resultRow;
            }  
            return $resultData;
        }

        if ($datatype == 'minute') {
            foreach ($data as $row) {
                $latitude = str_pad($row[0], 6, ' ', STR_PAD_LEFT);
                $longtitude = str_pad($row[1], 6, ' ', STR_PAD_LEFT);
                
                $year = "$row[2]";
                if (strlen($year) == 1) {
                    $year = "0$year";
                }
                $month = "$row[3]";
                if (strlen($month) == 1) {
                    $month = "0$month";
                }
                $day = "$row[4]";
                if (strlen($day) == 1) {
                    $day = "0$day";
                }

                $element = $row[6];
                $hour = $row[7];
                $observkod = $row[8];
                $tableDataType = $row[9];

                $minuteSets = array();
                for ($i = 10; $i<=70; $i++){
                    if ($row <> '999999') {
                        $minuteSets[] = str_pad($row[$i], 6, " ", STR_PAD_LEFT);;
                    } else {
                        $minuteSets[] = $row[$i];
                    }
                }

                $resultRow = "$latitude$longtitude$year$month$day$element$hour$observkod$tableDataType         $minuteSets[0]$minuteSets[1]$minuteSets[2]$minuteSets[3]$minuteSets[4]$minuteSets[5]$minuteSets[6]$minuteSets[7]$minuteSets[8]$minuteSets[9]$minuteSets[10]$minuteSets[11]$minuteSets[12]$minuteSets[13]$minuteSets[14]$minuteSets[15]$minuteSets[16]$minuteSets[17]$minuteSets[18]$minuteSets[19]$minuteSets[20]$minuteSets[21]$minuteSets[22]$minuteSets[23]$minuteSets[24]$minuteSets[25]$minuteSets[26]$minuteSets[27]$minuteSets[28]$minuteSets[29]$minuteSets[30]$minuteSets[31]$minuteSets[32]$minuteSets[33]$minuteSets[34]$minuteSets[35]$minuteSets[36]$minuteSets[37]$minuteSets[38]$minuteSets[39]$minuteSets[40]$minuteSets[41]$minuteSets[42]$minuteSets[43]$minuteSets[44]$minuteSets[45]$minuteSets[46]$minuteSets[47]$minuteSets[48]$minuteSets[49]$minuteSets[50]$minuteSets[51]$minuteSets[52]$minuteSets[53]$minuteSets[54]$minuteSets[55]$minuteSets[56]$minuteSets[57]$minuteSets[58]$minuteSets[59]$minuteSets[60]\n";
                $resultData[] = $resultRow;
            }
            return $resultData;
        }
    }

    public static function CSVformat($data, $datatype)
    {
        if ($datatype == 'hourly') {
            foreach ($data as $row) {
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
    
                $resultRow = "$observkod,$year,$month,$element,$day,  $usznk,$sostdays,$I,$basic,$hoursets[0],$hoursets[1],$hoursets[2],$hoursets[3],$hoursets[4],$hoursets[5],$hoursets[6],$hoursets[7],$hoursets[8],$hoursets[9],$hoursets[10],$hoursets[11],$hoursets[12],$hoursets[13],$hoursets[14],$hoursets[15],$hoursets[16],$hoursets[17],$hoursets[18],$hoursets[19],$hoursets[20],$hoursets[21],$hoursets[22],$hoursets[23],$hoursets[24],\n";
                array_shift($data);
                $resultData[] = $resultRow;
            }  
            return $resultData;
        }

        if ($datatype == 'minute') {
            foreach ($data as $row) {
                $latitude = str_pad($row[0], 6, ' ', STR_PAD_LEFT);
                $longtitude = str_pad($row[1], 6, ' ', STR_PAD_LEFT);
                
                $year = "$row[2]";
                if (strlen($year) == 1) {
                    $year = "0$year";
                }
                $month = "$row[3]";
                if (strlen($month) == 1) {
                    $month = "0$month";
                }
                $day = "$row[4]";
                if (strlen($day) == 1) {
                    $day = "0$day";
                }

                $element = $row[6];
                $hour = $row[7];
                $observkod = $row[8];
                $tableDataType = $row[9];

                $minuteSets = array();
                for ($i = 10; $i<=70; $i++){
                    if ($row <> '999999') {
                        $minuteSets[] = str_pad($row[$i], 6, " ", STR_PAD_LEFT);;
                    } else {
                        $minuteSets[] = $row[$i];
                    }
                }

                $resultRow = "$latitude,$longtitude,$year,$month,$day,$element,$hour,$observkod,$tableDataType,         $minuteSets[0],$minuteSets[1],$minuteSets[2],$minuteSets[3],$minuteSets[4],$minuteSets[5],$minuteSets[6],$minuteSets[7],$minuteSets[8],$minuteSets[9],$minuteSets[10],$minuteSets[11],$minuteSets[12],$minuteSets[13],$minuteSets[14],$minuteSets[15],$minuteSets[16],$minuteSets[17],$minuteSets[18],$minuteSets[19],$minuteSets[20],$minuteSets[21],$minuteSets[22],$minuteSets[23],$minuteSets[24],$minuteSets[25],$minuteSets[26],$minuteSets[27],$minuteSets[28],$minuteSets[29],$minuteSets[30],$minuteSets[31],$minuteSets[32],$minuteSets[33],$minuteSets[34],$minuteSets[35],$minuteSets[36],$minuteSets[37],$minuteSets[38],$minuteSets[39],$minuteSets[40],$minuteSets[41],$minuteSets[42],$minuteSets[43],$minuteSets[44],$minuteSets[45],$minuteSets[46],$minuteSets[47],$minuteSets[48],$minuteSets[49],$minuteSets[50],$minuteSets[51],$minuteSets[52],$minuteSets[53],$minuteSets[54],$minuteSets[55],$minuteSets[56],$minuteSets[57],$minuteSets[58],$minuteSets[59],$minuteSets[60],\n";
                $resultData[] = $resultRow;
            }
            return $resultData;
        }
    }

    public static function IAGA2002format($data, $datatype)
    {
        
    }
}