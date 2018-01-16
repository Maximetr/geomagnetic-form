<?php

require_once ('connect.php');

function dateCheck($connect) {
    $dates = array();
    $select = mysqli_query($connect, ("SELECT Date FROM hourdata"));

    while ($result = mysqli_fetch_array($select, MYSQLI_NUM)) {
        $dates[] = $result;
    }

    /* $filter19 = "(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)";
    $filter20 = "20([0-1]{1}[0-9]{1})-([0-1]{1}[0-9]{1})-([0-3]{1}[0-9]{1})"; */

    $count = count($dates);
    for ($i=0; $i<=$count;$i++) {
        $date = current($dates[$i]);
        $mdy = explode('-', $date);
        if (!(checkdate($mdy[1],$mdy[2],$mdy[0]))) {
            print_r($dates[$i]);
        }
    }

}

function 

dateCheck($connect);