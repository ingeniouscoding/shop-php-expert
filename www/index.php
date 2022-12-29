<?php

session_start();

$_SESSION['cart'] ??= [];

include_once '../config/config.php';
include_once '../config/db.php';
include_once '../library/mainFunctions.php';

$controllerName = isset($_GET['controller'])
    ? ucfirst($_GET['controller'])
    : 'Index';

$actionName = isset($_GET['action'])
    ? $_GET['action']
    : 'index';

if (isset($_SESSION['user'])) {
    $smarty->assign('user', $_SESSION['user']);
}

$smarty->assign('cartCountItems', count($_SESSION['cart']));

loadPage($smarty, $controllerName, $actionName);
