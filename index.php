<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>

<link  rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="leaflet/leaflet.css" />
</head>
<body>

    <div class = "mainbody clearfix">
        <div class="map" id="mapid" style="width: 855.58px; height: 433px"></div>
        
        
    <div class = "form">
        <form method="post" action="index.php">
                <div class = "datatype">
                    <div class = "head">
                        <h3>Вид данных</h3>
                    </div>
                    <div class = "hour">
                        <label class="ntSaveForms">
                            <input type="radio" name="typedata" class="ntSaveForms" value="3" checked />Среднечасовые
                        </label>
                    </div>
                </div>
            <div class = "observatory">
                <div class = "head">
                    <h3>Обсерватория</h3>
                </div>
                <div class = "obsselect">
                    <p>Название обсерватории</p>
                    <select  id="obsnametab" name="obsnametab">
                        <option value = "AAA">AAA</option>
                        <option value = "AIA">AIA</option>
                        <option value = "ARK">ARK</option>
                        <option value = "ASH">ASH</option>
                        <option value = "BOX">BOX</option>
                        <option value = "CSS">CSS</option>
                        <option value = "CWE">CWE</option>
                        <option value = "DIK">DIK</option>
                        <option value = "HIS">HIS</option>
                        <option value = "IRT">IRT</option>
                        <option value = "KGD">KGD</option>
                        <option value = "KIV">KIV</option>
                        <option value = "KZN">KZN</option>
                        <option value = "LNN">LNN</option>
                        <option value = "LVV">LVV</option>
                        <option value = "MGD">MGD</option>
                        <option value = "MOS">MOS</option>
                        <option value = "NVS">NVS</option>
                        <option value = "PET">PET</option>
                    </select>
                </div>
            </div>

            <div class = "timeselect">
                <div class = "head">
                    <h3>Временной интервал</h3>
                </div>
                <div class = "mintime">
                    <lable>От
                        <input type="text" name="date1" id="date1" class="ntSaveForms" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  size="10">                
                    </lablel>
                </div>
                <div class = "maxtime">
                    <lable>до
                        <input type="text" name="date2" id="date2" class="ntSaveForms" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  size="10">
                    </label>
                </div>
            </div>

            <div class = "output">
                <div class = "head">
                    <h3>Формат вывода данных</h3>
                </div>
                <div class = "formats">
                    <div class = "WDC">
                        <label>
                            <input type="radio" name="savedata" class="ntSaveForms" value="1" checked />WDC
                        </label>
                    </div>
                    <div class = "CSV">
                        <label>
                            <input type="radio" name="savedata" class="ntSaveForms" value="2" />CSV
                        </label>
                    </div>
                    <div class = "IAGA2002">
                        <label>
                            <input type="radio" name="savedata" class="ntSaveForms" value="3" />IAGA2002
                        </label>
                    </div>
                    <div class = "submit">
                        <input type="submit" value="Найти" name="submit1" id="" />
                    </div>
                    <textarea>
                        <?php
                        //error_reporting(E_ALL);
                        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                        include_once 'components/functions.php';
                        include_once 'models/newiaga.php';
                        include_once 'models/wdcb.php';
                        include_once 'models/csv.php';
                        ?>
                    </textarea>
                </div>
            </div>
        </form>
    </div>    
    <script type='text/javascript' src='ntsaveforms.js'></script>
    </div>
    <script src="leaflet/leaflet.js"></script>
    <script src="components/dronestrikes.js"></script>
    <script type='text/javascript' src='http://code.jquery.com/jquery-latest.min.js'></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="jquery/jquery.maskedinput.js"></script>
    <script type="text/javascript">
            jQuery(function($){
            $("#date1").mask("9999-99-99",{placeholder:"yyyy-mm-dd"});
            $("#date2").mask("9999-99-99",{placeholder:"yyyy-mm-dd"});
            });
    </script>
    <script src="main.js"></script>
</body>
</html>
    



