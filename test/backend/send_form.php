<?php

include_once 'boot.php';

if (!checkPromocode($_POST['Promocode'])) {
    header('Location: index.html');
    exit;
}

Db::migrate();

$user = User::create(
    $_POST['Name'],
    $_POST['Date'],
    $_POST['NickName'],
    $_POST['Phone'],
    implode(', ', $_POST['Employment']),
    $_POST['Sphere'],
    $_POST['Skills'],
    $_POST['Upgrade'],
    implode(', ', $_POST['Interests']),
    $_POST['Promocode']
);

Db::getInstance()->close();

header('Location: /success-page.html');