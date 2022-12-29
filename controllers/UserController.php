<?php

include_once '../models/CategoryModel.php';
include_once '../models/UserModel.php';

function indexAction(Smarty $smarty): void
{
    if (!isset($_SESSION['user'])) {
        redirect('/');
        return;
    }
    $categories = getAllCategories();

    $smarty->assign('categories', $categories);

    $smarty->display('user.tpl');
}

function registerAction(): void
{
    $json = file_get_contents('php://input');
    $request = json_decode($json, associative: true);

    $email = isset($request['email']) ? trim($request['email']) : null;

    $password = $request['password'] ?? null;
    $passwordConfirm = $request['password_confirm'] ?? null;

    $name = isset($request['name']) ? trim($request['name']) : null;
    $phone = $request['phone'] ?? null;
    $address = $request['address'] ?? null;

    $response = checkRegisterParams($email, $password, $passwordConfirm);

    if ($response['success'] && !isEmailUnique($email)) {;
        $response['success'] = false;
        $response['message'] = 'Email уже зарегистрирован';
    }

    if ($response['success']) {
        $hash = md5($password);
        $user = registerNewUser($email, $hash, $name, $phone, $address);
        if ($user['success']) {
            $response['message'] = 'Пользователь успешно зарегистрирован';
            $response['username'] = $user['name'] ?: $user['email'];

            setSessionUser($user);
        } else {
            $response['success'] = false;
            $response['message'] = 'Ошибка регистрации';
        }
    }

    echo json_encode($response);
}

function updateAction(): void
{
    if (!isset($_SESSION['user'])) {
        redirect('/');
        return;
    }

    $json = file_get_contents('php://input');
    $request = json_decode($json, associative: true);

    $response = ['success' => false];

    $currentPassword = $request['current_password'] ?? null;
    $currentHash = md5($currentPassword);

    if ($currentHash !== $_SESSION['user']['password']) {
        $response['message'] = 'Неверный пароль';
        echo json_encode($response);
        return;
    }

    $newPassword = $request['new_password'] ?? null;
    $newPasswordConfirm = $request['new_password_confirm'] ?? null;
    if ($newPassword && ($newPassword !== $newPasswordConfirm)) {
        $response['message'] = 'Пароли не совпадают';
        echo json_encode($response);
        return;
    }

    $email = $_SESSION['user']['email'] ?? null;
    $name = $request['name'] ?? null;
    $phone = $request['phone'] ?? null;
    $address = $request['address'] ?? null;
    $newHash = $newPassword ? md5($newPassword) : null;

    $isUpdated = updateUserData($email, $name, $phone, $address, $currentHash, $newHash);

    if (!$isUpdated) {
        $response['message'] = 'Ошибка сохранения';
        echo json_encode($response);
        return;
    }

    $user = getUser($email, $newHash ?: $currentHash);
    setSessionUser($user);

    $response['success'] = true;
    $response['message'] = 'Успешно обновлено';
    echo json_encode($response);
}

function loginAction(): void
{
    $json = file_get_contents('php://input');
    $request = json_decode($json, associative: true);

    $email = isset($request['email']) ? trim($request['email']) : null;
    $password = $request['password'] ?? null;

    $user = loginUser($email, md5($password));

    if (!$user) {
        $response = [
            'success' => false,
            'message' => 'Неверный логин или пароль',
        ];
        echo json_encode($response);
        return;
    }

    setSessionUser($user);

    $response = [
        'success' => true,
        'username' => $user['name'] ?: $user['email'],
    ];
    echo json_encode($response);
}

function logoutAction(): void
{
    unset($_SESSION['user'], $_SESSION['cart']);

    redirect('/');
}

function setSessionUser(array $user)
{
    $_SESSION['user'] = $user;
    $_SESSION['user']['username'] = $user['name'] ?: $user['email'];
}
