<?php

function  getLastProducts(int $limit = 20): array
{
    global $db;
    $query = <<<SQL
        SELECT
            `id`,
            `category_id`,
            `name`,
            `description`,
            `price`,
            `image`,
            `status`
        FROM
            `product`
        ORDER BY
            `id` DESC
        LIMIT ?;
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $limit);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}

function getProductsByCategory(int $categoryId, int $limit = 20): array
{
    global $db;
    $query = <<<SQL
        SELECT
            `id`,
            `category_id`,
            `name`,
            `description`,
            `price`,
            `image`,
            `status`
        FROM
            `product`
        WHERE
            `category_id` = ?
        ORDER BY
            `id` DESC
        LIMIT ?;
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $categoryId, $limit);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}

function getProductById(int $productId): array
{
    global $db;
    $query = <<<SQL
        SELECT
            `id`,
            `category_id`,
            `name`,
            `description`,
            `price`,
            `image`,
            `status`
        FROM
            `product`
        WHERE
            `id` = ?;
    SQL;


    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row;
}

function getProductsFromArray(array $itemIds): array
{
    global $db;

    if (!$itemIds) {
        return [];
    }

    $in = join(',', array_fill(0, count($itemIds), '?'));
    $query = <<<SQL
        SELECT
            `id`,
            `category_id`,
            `name`,
            `description`,
            `price`,
            `image`,
            `status`
        FROM
            `product`
        WHERE
            `id` IN ($in);
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param(str_repeat('i', count($itemIds)), ...$itemIds);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}
