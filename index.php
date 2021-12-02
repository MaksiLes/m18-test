<?php

require_once "vendor/autoload.php";

use Src\Connection;
use Src\LinkCreator;

$pdo = Connection::GetInstance();
$linkCreator = new LinkCreator($pdo);

if ($_SERVER['REQUEST_METHOD' != "GET"])
{
    die();
}

$path = trim($_SERVER['REQUEST_URI']);
$urlError = "";

if ($path !== "/")
{
    $code = str_replace("/", "", $path);
    $code = strtok($code, "?");

    $stmt = $pdo->prepare('SELECT * FROM links WHERE code = ?');
    $stmt->execute([$code]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row !== false)
    {
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
