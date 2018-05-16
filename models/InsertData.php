<?php

class InsertData {
    public static function Check($file) {

        $regular = "/([\\s*0-9]{6}){2}([0-9]{2})(0[0-9]|1[0-2])([0-3][0-9])[X|Y|Z|D|H|F]([0-2][0-9])([A-Z]{3})([D|A]{1})(\\s{9})([\\s|9][\\s*0-9]{5}){61}/";

        $fileHandler = fopen($file, 'a+');
        $lineNumber = 1;

        while (!feof($fileHandler)) {
            $row = fgets($fileHandler, 4096);

            $checkResult = preg_match($regular, $row);

            if ($checkResult == false) {
                $error = "Строка номер $lineNumber введена неверно";
                return $error;
                break;
            }
            $lineNumber++;
        }

        return true;
    }
}