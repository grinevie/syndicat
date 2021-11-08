<?php

include_once 'boot.php';

$key = '123456';

$auth = isset($_COOKIE['hash']) && $_COOKIE['hash'] === md5($key);
$correctPassword = isset($_POST['key']) && $_POST['key'] === $key;
$incorrectPassword = isset($_POST['key']) && $_POST['key'] !== $key;

if (!$auth) {
    if ($correctPassword) {
        setcookie("hash", md5($key), time() + 60 * 24 * 30 * 365);
        header("Location: admin.php");
    }
    if ($incorrectPassword) {
        echo "Неверный ключ";
    }

    echo <<<HTML
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Админ панель</title>
    </head>
    <body>
        <form method="POST">
            <input name="key" type="text" placeholder="Ключ">
            <button type="submit">Войти</button>
        </form>
    </body>
    </html>
    HTML;

    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
</head>
<body>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>date</th>
        <th>nickname</th>
        <th>phone</th>
        <th>employment</th>
        <th>sphere</th>
        <th>skills</th>
        <th>upgrade</th>
        <th>interests</th>
        <th>promocode</th>
        <th>created at</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach (User::getAll() as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['date'] ?></td>
            <td><?= $user['nickname'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['employment'] ?></td>
            <td><?= $user['sphere'] ?></td>
            <td><?= $user['skills'] ?></td>
            <td><?= $user['upgrade'] ?></td>
            <td><?= $user['interests'] ?></td>
            <td><?= $user['promocode'] ?></td>
            <td><?= $user['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tr></tr>
</table>

<style>
    table {
        border-collapse: collapse;
    }

    body {
        font-family: Arial, sans-serif;
    }

    td {
        padding: 10px 10px;
        font-size: 15px;
    }

    thead {
        background: #eee;
    }

    th {
        padding: 10px;
        text-transform: capitalize;
    }

    tr:hover {
        background: #eee;
    }

</style>

</body>
</html>