<?php

$db_params = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'db_name' => 'testtest',
);
$dbhost = $db_params['host'];
$dbuser = $db_params['user'];
$dbpassword = $db_params['password'];
$dbname = $db_params['db_name'];
$connect = mysqli_connect("$dbhost", "$dbuser", "$dbpassword", "$dbname");//параметры в скобках ("хост", "имя пользователя", "пароль", "имя БД")
if (!$connect) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;																				//подключение к mysqli
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$filename = 'inputfile.txt';

$fh = fopen($filename, 'a+');





$linenumber = 1;

while (!feof($fh)) {
    $line = fgets($fh, 4096);
    $latitude = trim(substr($line, 0, 6), ' ');
    $longtitude = trim(substr($line, 6, 6), ' ');
    $year = substr($line, 12, 2);
    $month = trim(ltrim(substr($line, 14, 2), '0'), ' ');
    $day = trim(ltrim(substr($line, 16, 2), '0'), ' ');
    $element = substr($line, 18, 1);
    $hour = substr($line, 19, 2);
    $code = substr($line, 21, 3);
    $datatype = substr($line,24,1);
    $date = makeDate($year, $month, $day);

    $minutevalues = array();
    $hourvalues = array();
    for ($i = 34, $j = strlen($line); $i < $j;) {
        if ($line[$i] == '9' && $i <> 394) {
            $minutevalues[] = '999999';
        }   elseif ($line[$i] == ' ' && $i <> 394) {
            $minutevalues[] = trim(substr($line,$i+1,5),' ');
        }
        if ($i == 394 && $line[$i] <> '9') {
            $hourvalues = trim(substr($line,395,5), ' ');
        } elseif ($i == 394 && $line[$i] == '9') {
            $hourvalues = '999999';
        }
        $i = $i+6;
    }

    $insert = mysqli_query($connect, ("INSERT INTO `minutedata` (`Latitude`,`Longtitude`,`Year`,`Month`,`Day`,`Date`,`Element`,`Hour`,`Kod`,`DataType`,`MinuteSet1`,`MinuteSet2`,`MinuteSet3`,`MinuteSet4`,`MinuteSet5`,`MinuteSet6`,`MinuteSet7`,`MinuteSet8`,`MinuteSet9`,`MinuteSet10`,`MinuteSet11`,`MinuteSet12`,`MinuteSet13`,`MinuteSet14`,`MinuteSet15`,
                            `MinuteSet16`,`MinuteSet17`,`MinuteSet18`,`MinuteSet19`,`MinuteSet20`,`MinuteSet21`,`MinuteSet22`,`MinuteSet23`,`MinuteSet24`,`MinuteSet25`,`MinuteSet26`,`MinuteSet27`,`MinuteSet28`,`MinuteSet29`,`MinuteSet30`,
                            `MinuteSet31`,`MinuteSet32`,`MinuteSet33`,`MinuteSet34`,`MinuteSet35`,`MinuteSet36`,`MinuteSet37`,`MinuteSet38`,`MinuteSet39`,`MinuteSet40`,`MinuteSet41`,`MinuteSet42`,`MinuteSet43`,`MinuteSet44`,`MinuteSet45`,
                            `MinuteSet46`,`MinuteSet47`,`MinuteSet48`,`MinuteSet49`,`MinuteSet50`,`MinuteSet51`,`MinuteSet52`,`MinuteSet53`,`MinuteSet54`,`MinuteSet55`,`MinuteSet56`,`MinuteSet57`,`MinuteSet58`,`MinuteSet59`,`MinuteSet60`,`HourSet`)
                            VALUES ('$latitude','$longtitude','$year','$month','$day','$date','$element','$hour','$code','$datatype','$minutevalues[0]','$minutevalues[1]','$minutevalues[2]','$minutevalues[3]','$minutevalues[4]','$minutevalues[5]','$minutevalues[6]','$minutevalues[7]','$minutevalues[8]','$minutevalues[9]','$minutevalues[10]',
                            '$minutevalues[11]','$minutevalues[12]','$minutevalues[13]','$minutevalues[14]','$minutevalues[15]','$minutevalues[16]','$minutevalues[17]','$minutevalues[18]','$minutevalues[19]','$minutevalues[20]','$minutevalues[21]','$minutevalues[22]','$minutevalues[23]','$minutevalues[24]','$minutevalues[25]','$minutevalues[26]',
                            '$minutevalues[27]','$minutevalues[28]','$minutevalues[29]','$minutevalues[30]','$minutevalues[31]','$minutevalues[32]','$minutevalues[33]','$minutevalues[34]','$minutevalues[35]','$minutevalues[36]','$minutevalues[37]','$minutevalues[38]','$minutevalues[39]','$minutevalues[40]','$minutevalues[41]','$minutevalues[42]',
                            '$minutevalues[43]','$minutevalues[44]','$minutevalues[45]','$minutevalues[46]','$minutevalues[47]','$minutevalues[48]','$minutevalues[49]','$minutevalues[50]','$minutevalues[51]','$minutevalues[52]','$minutevalues[53]','$minutevalues[54]','$minutevalues[55]','$minutevalues[56]','$minutevalues[57]','$minutevalues[58]',
                            '$minutevalues[59]','$hourvalues')"));

    if ($insert) {
        echo 'Строка '.$linenumber." успешно добавлена в бд</br>";
    }   else {
        echo 'Ошибка добавления строки '.$linenumber."</br>";
    }



    unset($minutevalues);
    unset($hourvalues);
    $linenumber++;
}


function makeDate($year, $month, $day) {
    if ($month < 10) {
        $month = '0'.$month;
    }
    if ($day < 10) {
        $day = '0'.$day;
    }

    if ($year < 25) {
        $date = '20'.$year.'-'.$month.'-'.$day;
    } else {
        $date = '19'.$year.'-'.$month.'-'.$day;
    }

    return $date;
}