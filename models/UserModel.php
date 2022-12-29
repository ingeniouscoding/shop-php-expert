<?php

function registerNewUser($email, $hash, $name, $phone, $address): array
{
    global $db;

    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    $name = htmlspecialchars(mysqli_real_escape_string($db, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($db, $phone));
    $address = htmlspecialchars(mysqli_real_escape_string($db, $address));

    $query = <<<SQL
        INSERT INTO `user`
            (`email`, `password`, `name`, `phone`, `address`)
        VALUES
            (?, ?, ?, ?, ?);
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $email, $hash, $name, $phone, $address);
    $ok = $stmt->execute();

    if (!$ok) {
        return ['success' => false];
    }

    $result = getUser($email, $hash);
    if (!$result) {
        return ['success' => false];
    }
    $result['success'] = true;

    return $result;
}

function checkRegisterParams($email, $password, $passwordConfirm)
{
    if (!$email) {
        return [
            'success' => false,
            'message' => 'Введите email',
        ];
    }

    if (!$password) {
        return [
            'success' => false,
            'message' => 'Введите пароль',
        ];
    }

    if (!$passwordConfirm) {
        return [
            'success' => false,
            'message' => 'Подтвердите пароль',
        ];
    }

    if ($password !== $passwordConfirm) {
        return [
            'success' => false,
            'message' => 'Пароли должны совпадать',
        ];
    }

    return ['success' => true];
}

function isEmailUnique(string $email): bool
{
    global $db;
    $query = <<<SQL
        SELECT
            `id`
        FROM
            user
        WHERE
            `email` = ?
        LIMIT 1;
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return !$result;
}

function loginUser(string $email, string $hash): array|null
{
    global $db;

    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    return getUser($email, $hash);
}

function updateUserData(
    string $email,
    string $name,
    string $phone,
    string $address,
    string $currentHash,
    string $newHash = null,
): bool {
    global $db;

    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    $name = htmlspecialchars(mysqli_real_escape_string($db, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($db, $phone));
    $address = htmlspecialchars(mysqli_real_escape_string($db, $address));

    $query = 'UPDATE user SET ';
    if ($newHash) {
        $query .= "`password` = '{$newHash}', ";
    }
    $query .= <<<SQL
            `name` = ?,
            `phone` = ?,
            `address` = ?
        WHERE
            `email` = ?
            AND `password` = ?
        LIMIT 1;
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $name, $phone, $address, $email, $currentHash);
    $isExecuted = $stmt->execute();
    $stmt->close();

    return $isExecuted;
}

function getUser(string $email, string $hash): array|null
{
    global $db;

    $query = <<<SQL
        SELECT
            `id`,
            `email`,
            `name`,
            `phone`,
            `address`,
            `password`
        FROM
            user
        WHERE
            `email` = ?
            AND `password` = ?
        LIMIT 1;
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $email, $hash);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $result;
}
