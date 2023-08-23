<?php

function SQL ($sqlQuery) {
    require_once 'sql.php';
    $dbc = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$pass");
    $result = $dbc->prepare($sqlQuery);
    $result->execute();
    return $result;
}