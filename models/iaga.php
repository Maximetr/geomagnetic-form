<?php
require_once('components/functions.php');
$table = array();

$query = mysqli_query($connect, ("SELECT Kod, Element, Date, Basic, HourSet1,HourSet2,HourSet3,HourSet4,HourSet5,HourSet6,HourSet7,HourSet8,HourSet9,HourSet10,HourSet11,HourSet12,HourSet13,HourSet14,HourSet15,HourSet16,HourSet17,HourSet18,HourSet19,HourSet20,HourSet21,HourSet22,HourSet23,HourSet24
								FROM hourdata WHERE Kod = '$iagaKod' AND Date >= '$mindate' AND Date <= '$maxdate' ORDER BY Date"));

while ($result = mysqli_fetch_array($query, MYSQLI_NUM)) {                    //		запись результата запроса в массив
    $table[] = $result;
}

//print_r ($table);

$elements = ElementChek($table);
    
$end = end($table);
$lastkey = key($table);
    
for ($i=0, $j=0;$i<=$lastkey; $j++) {
    $newtable[$j] = RowJob($table[$i], $table[$i+1], $table[$i+2], $table[$i+3]);
    $i = $i+3;
}
//print_r($newtable);
    
output($newtable, $elements, $iagaKod);






//echo date("z", mktime(0, 0, 0, 12, 30, 1980));
?>