<?php

class AssistantFunctions
{
    public static function elementCheck($row0, $row1, $row2, $row3)
    {
        $F = self::checkF($row0, $row1, $row2, $row3);

        $elementSet = 'DHZ';
        
        if ($F) {
            $elementSet = 'DFHZ';
        }
        
        if ($row0[1] == 'X' or $row1[1] == 'X' or $row2[1] == 'X' or $row3[1] == 'X') {
            $elementSet = 'XYZ';
            if ($F) {
                $elementSet = 'FXYZ';
            }
        }
        return $elementSet;
    }
    
    public static function checkF($row0, $row1, $row2, $row3)
    {
        if ($row0[1] == 'F' or $row1[1] == 'F' or $row2[1] == 'F' or $row3[1] == 'F') {
            return true;
        }
        return false;
    }

    public static function recalculateElement($data, $elementSet) 
    {
        
        $recalculateData = array();
            foreach ($data as $row) {
                for ($i=4; $i<=27; $i++) {
                    if ($row[$i] == '9999') {
                        $row[$i] = '99999.00';
                    }   elseif ($row[1] == 'D' or $row[1] == 'I') {
                        $row[$i] = $row[3]*60+$row[$i]/10;
                        if (is_int($row[$i])) {
                            $row[$i] = "$row[$i]".".00";
                        }
                        if (is_float($row[$i])) {
                            $row[$i] = "$row[$i]"."0";
                        }
                    } else {
                        $row[$i] = $row[3]*100+$row[$i];
                        if (is_int($row[$i])) {
                            $row[$i] = "$row[$i]".".00";
                        }
                        if (is_float($row[$i])) {
                            $row[$i] = "$row[$i]"."0";
                        }
                    }
                }
                $recalculateData[] = $row;
            }
        return $recalculateData;
    }

}
