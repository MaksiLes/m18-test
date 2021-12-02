<?php

namespace Src;

use PDO;

class Connection
{
    public const HOST = '127.0.0.1';
    public const PORT = 3306;
    public const DB_NAME = 'm18_test';
    public const USER_NAME = 'root';
    public const PASS = 'qwerty';

    private static PDO $pdo;

    public static function GetInstance(): PDO
    {
        if (!isset(static::$pdo)) {
            $dsn = sprintf("mysql:host=%s;port=%d;dbname=%s", self::HOST, self::PORT, self::DB_NAME);

            static::$pdo = new PDO($dsn, self::USER_NAME, self::PASS);
        }

        return static::$pdo;
    }
}
