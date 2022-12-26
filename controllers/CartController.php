<?php

include_once '../models/CategoryModel.php';
include_once '../models/ProductModel.php';

function indexAction(Smarty $smarty)
{
    $itemIds = $_SESSION['cart'];

    $products = getProductsFromArray($itemIds);
    $categories = getAllCategories();

    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('categories', $categories);
    $smarty->assign('products', $products);

    loadTemplate($smarty, 'cart');
}

function addtocartAction(): void
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$itemId) {
        exit();
    }

    $response = ['success' => false];

    if (array_search($itemId, $_SESSION['cart']) === false) {
        $_SESSION['cart'][] = $itemId;
        $response['countItems'] = count($_SESSION['cart']);
        $response['success'] = true;
    }

    echo json_encode($response);
}

function removefromcartAction(): void
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$itemId) {
        exit();
    }

    $response = ['success' => false];
    $key = array_search($itemId, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $response['countItems'] = count($_SESSION['cart']);
        $response['success'] = true;
    }

    echo json_encode($response);
}
