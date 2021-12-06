<?php

use Src\Config;
use Src\Connection;

require_once 'vendor/autoload.php';

$cfg = include 'config.php';

$config = new Config($cfg['host'], $cfg['port'], $cfg['db_name'], $cfg['user_name'], $cfg['pass']);
$pdo = Connection::getInstance($config);

$clicks = $pdo->query('SELECT url, clicks FROM links JOIN clicks ON links.id = clicks.link_id');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="file.css" rel="stylesheet">
    <title>Статистика переходов</title>
    <link rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="title">Статистика переходов</h1>
    <table>
        <tr>
            <th >ссылка</th>
            <th>количество</th>
        </tr>
        <?php foreach ($clicks as $row): ?>
        <tr>
            <td><?=$row['url']?></td>
            <td><?=$row['clicks']?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
