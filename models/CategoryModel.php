<?php

function createCategoryTree(array $arr, int $parentId = 0): array
{
    $parents = array_filter($arr, fn ($c) => $c['parent_id'] == $parentId);
    foreach ($parents as $i => $category) {
        $children = createCategoryTree($arr, $category['id']);
        if ($children) {
            $parents[$i]['children'] = $children;
        }
    }
    return $parents;
}

function getAllCategories(): array
{
    global $db;
    $query = 'SELECT id, parent_id, name FROM category';

    $result = $db->query($query);
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return createCategoryTree($rows);
}
