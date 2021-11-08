<?php


class Db
{
    private static $instance;

    public static function getInstance(): SQLite3
    {
        if (!isset(self::$instance)) {
            self::$instance = new SQLite3('sqlite.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        }

        return self::$instance;
    }

    public static function migrate(): SQLite3Result
    {
        return self::getInstance()->query('CREATE TABLE IF NOT EXISTS "users" (
            "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            "name" VARCHAR(120),
            "date" VARCHAR(120),
            "nickname" VARCHAR(120),
            "phone" VARCHAR(120),
            "employment" VARCHAR(120),
            "sphere" VARCHAR(120),
            "skills" MESSAGE_TEXT,
            "upgrade" VARCHAR(120),
            "interests" MESSAGE_TEXT,
            "promocode" VARCHAR(32),
            "created_at" CURRENT_TIMESTAMP 
        )');
    }
}

class User
{

    public static function create($name, $date, $nickname, $phone, $employment, $sphere, $skills, $upgrade, $interests, $promocode): bool
    {
        $data = [
            '`name`' => "'" . $name . "'",
            '`date`' => "'" . $date . "'",
            '`nickname`' => "'" . $nickname . "'",
            '`phone`' => "'" . $phone . "'",
            '`employment`' => "'" . $employment . "'",
            '`sphere`' => "'" . $sphere . "'",
            '`skills`' => "'" . $skills . "'",
            '`upgrade`' => "'" . $upgrade . "'",
            '`interests`' => "'" . $interests . "'",
            '`promocode`' => "'" . $promocode . "'",
            '`created_at`' => "'" . date('Y.m.d') . "'",
        ];

        $columns = implode(',', array_keys($data));
        $values = implode(',', array_values($data));

        if (Db::getInstance()->query("INSERT INTO `users` ($columns) VALUES ($values)")) {
            return true;
        }

        return false;
    }

    public static function getAll(): array
    {
        $users = Db::getInstance()->query('SELECT * FROM "users"');
        $data = [];
        while ($user = $users->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $user;
        }
        return $data;
    }
}

function checkPromocode($check): bool
{
    $promocodes = include_once 'promocodes.php';
    return in_array($check, $promocodes);
}