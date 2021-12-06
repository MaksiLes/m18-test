<?php

use Src\Config;
use Src\Connection;
use Src\LinkCreator;

require_once "vendor/autoload.php";

$cfg = include 'config.php';

$config = new Config($cfg['host'], $cfg['port'], $cfg['db_name'], $cfg['user_name'], $cfg['pass']);
$pdo = Connection::getInstance($config);

if (isset($_POST['url'])) {
    $url = $_POST['url'];

    $linkCreator = new LinkCreator($pdo);
    $link = $linkCreator->getLink($url);

    $shortLink = "http://" . $_SERVER['HTTP_HOST'] . "/code/" . $link->getCode();

    echo 'Ваша короткая ссылка: ' . '<a href="' . $shortLink . '">' . $shortLink . '</a>';
}