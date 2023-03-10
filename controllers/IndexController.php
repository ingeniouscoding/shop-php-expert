<?php

include_once '../models/CategoryModel.php';
include_once '../models/ProductModel.php';

function indexAction(Smarty $smarty): void
{
    $categories = getAllCategories();
    $products = getLastProducts(16);

    $smarty->assign('categories', $categories);
    $smarty->assign('products', $products);

    $smarty->display('index.tpl');
}
