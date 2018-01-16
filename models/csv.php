<?php
    $table = array();

    $query = mysqli_query($connect, ("SELECT * FROM hourdata WHERE Kod ='$iagaKod' AND Date>='$mindate' AND Date<='$maxdate'"));
    
    while ($result = mysqli_fetch_array($query, MYSQLI_NUM)) {                    //		запись результата запроса в массив
        $table[] = $result;
    }
$end = end($table);
$lastkey = key($table);  
for ($i=0; $i<=$lastkey; $i++) {
    $observkod = $table[$i][0];
    $year = $table[$i][1];
    $month = $table[$i][2];
    $element = $table[$i][3];
    $day = $table[$i][4];
    $usznk = $table[$i][6];
    $sostdays = $table[$i][7];
    $I_ = $table[$i][8];
    $basic = $table[$i][9];
    $hoursets = array($table[$i][10],$table[$i][11],$table[$i][12],$table[$i][13],$table[$i][14],$table[$i][15],$table[$i][16],$table[$i][17],$table[$i][18],$table[$i][19],$table[$i][20],$table[$i][21],$table[$i][22],$table[$i][23],$table[$i][24],$table[$i][25],$table[$i][26],$table[$i][27],$table[$i][28],$table[$i][29],$table[$i][30],$table[$i][31],$table[$i][32],$table[$i][33],$table[$i][34]);
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
    if ($I_ == "9") {
        $I_ = " ";
    }
    if ($day<=9){
        $day = "0$day";
    }
    if ($month<=9){
        $month = "0$month";
    }
    $basic = str_pad($basic, 4, "0", STR_PAD_LEFT);
    
$row = "$observkod,$year,$month,$element,$day,  $usznk,$sostdays,$I_,$basic,$hoursets[0],$hoursets[1],$hoursets[2],$hoursets[3],$hoursets[4],$hoursets[5],$hoursets[6],$hoursets[7],$hoursets[8],$hoursets[9],$hoursets[10],$hoursets[11],$hoursets[12],$hoursets[13],$hoursets[14],$hoursets[15],$hoursets[16],$hoursets[17],$hoursets[18],$hoursets[19],$hoursets[20],$hoursets[21],$hoursets[22],$hoursets[23],$hoursets[24],\n";
echo $row;

}

?>