<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Геомагнитные данные</title>

<link  rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="leaflet/leaflet.css" />
</head>
<body>
    <header>
        <div class="logo">
            Лого
        </div>
    </header>
    <div class = "mainbody">
        <div class = "content clearfix">
            <div class="map" id="mapid" style="width: 855.58px; height: 433px"></div>
        

            <div class = "form">
                <form method="post" action="index.php">
                        <div class = "formblock">
                            <h3>Вид данных</h3>
                                <label class="ntSaveForms">
                                    <input type="radio" name="typedata" class="ntSaveForms" value="3" checked />Среднечасовые
                                </label>
                        </div>
                    <div class = "formblock">
                        <h3>Обсерватория</h3>
                            <p>Название обсерватории</p>
                            <select  id="obsnametab" name="obsnametab" onchange="onSelectChange()">
                                <option value = "AAA">AAA, Alma-Ata</option>
                                <option value = "AIA">AIA, Argentine Islands</option>
                                <option value = "ARK">ARK, Arkhangelsk</option>
                                <option value = "ASH">ASH, Ashkhabad</option>
                                <option value = "BOX">BOX, Borok</option>
                                <option value = "CSS">CSS, Cape Chelyuskin</option>
                                <option value = "CWE">CWE, Cape  Wellen (Uelen)</option>
                                <option value = "DIK">DIK, Dixon (Dikson Island)</option>
                                <option value = "HIS">HIS, Heiss Island (Druzhnaya)</option>
                                <option value = "IRT">IRT, Irkutsk (Patrony)</option>
                                <option value = "KGD">KGD, Karaganda</option>
                                <option value = "KIV">KIV, Kiev</option>
                                <option value = "KZN">KZN, Kazan</option>
                                <option value = "LNN">LNN, Voyekovo (Leningrad)</option>
                                <option value = "LVV">LVV, Lvov</option>
                                <option value = "MGD">MGD, Magadan</option>
                                <option value = "MOS">MOS, Moscow</option>
                                <option value = "NVS">NVS, Novosibirsk</option>
                                <option value = "PET">PET, Paratunka (Petropavlovsk)</option>
                            </select>
                    </div>

                    <div class = "formblock">
                        <h3>Временной интервал</h3>
                        <lable>от
                            <input type="text" name="date1" id="date1" class="ntSaveForms" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  size="10" required>                
                        </lablel>
                        <lable>до
                            <input type="text" name="date2" id="date2" class="ntSaveForms" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  size="10" required>
                        </label>
                    </div>

                    <div class = "output">
                        <h3>Формат вывода данных</h3>
                            <label>
                                <input type="radio" name="savedata" class="ntSaveForms" value="WDC" checked />WDC
                            </label>
                            <div class="formatCheckbox">
                                <label>
                                    <input type="radio" name="savedata" class="ntSaveForms" value="CSV" />CSV
                                </label>
                            </div>
                            <div class="formatCheckbox">
                                <label>
                                    <input type="radio" name="savedata" class="ntSaveForms" value="IAGA2002" />IAGA2002
                                </label>
                            </div></br>
                                <input class="button" type="submit" value="Найти" name="submit1" id="" /></br>
                                <div class="help"><a href="javascript:sh()">Помощь</a></div>
                    </div>
            </div>
            
                            <div id="info" style="padding-top:15px;">
                            <p>помощь помощь помощь помощь помощь помощь помощь помощь помощь помощь помощь помощь помощь </p>
                            </div>
                            <?php if (isset($_POST['submit1'])) : ?>
                            <div class="textarea clearfix">
                                <textarea readonly><?php
                                    /* error_reporting(E_ALL);
                                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); */
                                    require_once('components/connect.php');
                                    $iagaKod = $_REQUEST['obsnametab'];
                                    $mindate = $_REQUEST['date1'];
                                    $maxdate = $_REQUEST['date2'];
                                    $format = $_REQUEST['savedata'];
                                    if ($format == 'WDC') {
                                        include_once('models/wdcb.php');
                                    }
                                    if ($format == 'CSV') {
                                        include_once('models/csv.php');
                                    }
                                    if ($format == 'IAGA2002') {
                                        include_once('models/iaga.php');
                                    }

                                    ?></textarea>
                                    <?php endif; ?>
                            </div>                  
                </form>           
        </div>
        <footer>
            
        </footer>
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
<script type="text/javascript">
    sh();
    function sh() {
    obj = document.getElementById("info");
    if( obj.style.display == "none" ) { obj.style.display = "block"; } else { obj.style.display = "none"; }
    }
</script>
<script src="main.js"></script>
</body>
</html>
    



