<?php

require_once "vendor/autoload.php";

$cfg = include 'config.php';

use Src\Config;
use Src\Connection;
use Src\LinkCreator;

$config = new Config($cfg['host'], $cfg['port'], $cfg['db_name'], $cfg['user_name'], $cfg['pass']);
$pdo = Connection::getInstance($config);
$linkCreator = new LinkCreator($pdo);

function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

if ($_SERVER['REQUEST_METHOD' != "GET"])
{
    die();
}

$path = trim($_SERVER['REQUEST_URI']);
$urlError = "";

if (startsWith($path, "/code/"))
{
    $code = str_replace("/code/", "", $path);
    $code = strtok($code, "?");

    $stmt = $pdo->prepare('SELECT * FROM links WHERE code = ? and created + interval 30 day >= now()');
    $stmt->execute([$code]);
    $row = $stmt->fetch();
    if ($row !== false)
    {
        $stmt = $pdo->prepare(
            'INSERT INTO clicks (link_id, clicks) VALUES (?,1) ON DUPLICATE KEY UPDATE clicks=clicks+1;'
        );
        $stmt->execute([$row['id']]);

        header("Location: {$row['url']}");
        exit();
    }

    $urlError = "такой короткой ссылки не существует";
}
?>

<?php if ($path === "/"): ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Сокращатель URL</title>
      <link rel="stylesheet">
    </head>
    <body>
      <div class="container">
       <h1 class="title">Сокращатель URL</h1>
       <form action="shorten.php" method="post">
        <input type="url" name="url" placeholder="Введите URL" autocomplete="off">
        <input type="submit" value="Сократить">
       </form>
      </div>
    </body>
    </html>
<?php endif ?>

<?php if ($urlError !== ""): ?>
    <?=$urlError?><br>
    <a href="/">Вернуться на главную</a>
<?php endif; ?>
