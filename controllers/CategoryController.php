<?php

include_once '../models/CategoryModel.php';
include_once '../models/ProductModel.php';

function indexAction(Smarty $smarty): void
{
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$id) {
        exit();
    }

    $children = null;
    $products = null;

    $category = getCategoryById($id);
    if ($category['parent_id'] == 0) {
        $children = getChildrenForCategory($id);
    } else {
        $products = getProductsByCategory($id);
    }

    $categories = getAllCategories();

    $smarty->assign('category', $category);
    $smarty->assign('categories', $categories);
    $smarty->assign('products', $products);
    $smarty->assign('childrenCategories', $children);

    $smarty->display('category.tpl');
}
