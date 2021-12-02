<?php

use Src\Connection;
use Src\LinkCreator;

require_once "vendor/autoload.php";

$pdo = Connection::GetInstance();

if (isset($_POST['url'])) {
    $url = $_POST['url'];

    $linkCreator = new LinkCreator($pdo);
    $link = $linkCreator->getLink($url);

    $shortLink = "http://" . $_SERVER['HTTP_HOST'] . "/" . $link->getCode();

    echo 'Ваша короткая ссылка: ' . '<a href="' . $shortLink . '">' . $shortLink . '</a>';
}