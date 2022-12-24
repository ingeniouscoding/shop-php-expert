<?php

include_once '../models/CategoryModel.php';

function indexAction(Smarty $smarty): void
{
    $categories = getAllCategories();

    $smarty->assign('pageTitle', 'Главная страница');
    $smarty->assign('categories', $categories);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}
