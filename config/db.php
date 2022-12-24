<?php

$dbhost = '127.0.0.1';
$dbname = 'shop_php_expert';
$dbuser = 'root';
$dbpassword = NULL;

$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$db) {
    echo 'Ошибка доступа к mysql';
    exit();
}
