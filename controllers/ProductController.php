<?php

include_once '../models/CategoryModel.php';
include_once '../models/ProductModel.php';

function indexAction(Smarty $smarty): void
{
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$id) {
        exit();
    }

    $product = getProductById($id);
    $categories = getAllCategories();

    $smarty->assign('inCart', in_array($id, $_SESSION['cart']));
    $smarty->assign('pageTitle', 'Описание товара ' . $product['name']);
    $smarty->assign('categories', $categories);
    $smarty->assign('product', $product);

    $smarty->display('product.tpl');
}
