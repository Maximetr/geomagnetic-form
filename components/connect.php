<?php
$connect = mysqli_connect("localhost", "root", "nimda!mysql", "testtest");//параметры в скобках ("хост", "имя пользователя", "пароль", "имя БД")
if (!$connect) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;																				//подключение к mysqli
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>