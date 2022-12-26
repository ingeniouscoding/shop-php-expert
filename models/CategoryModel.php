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
    $query = 'SELECT `id`, `parent_id`, `name` FROM `category`;';

    $result = $db->query($query);
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return createCategoryTree($rows);
}

function getCategoryById(int $categoryId)
{
    global $db;
    $query = 'SELECT `id`, `parent_id`, `name` FROM `category` WHERE `id` = ?;';

    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $categoryId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row;
}

function getChildrenForCategory(int $parentId)
{
    global $db;
    $query = <<<SQL
        SELECT
            `id`,
            `parent_id`,
            `name`
        FROM
            `category`
        WHERE
            `parent_id` = ?;
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $parentId);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}
