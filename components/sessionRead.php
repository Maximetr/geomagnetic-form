<?php

if (isset($_SESSION['progress'])) {
    $progress = $_SESSION['progress'];
    echo $progress;
}

exit();