<?php

namespace Src;

use PDO;

class LinkCreator
{
    private \PDO $conn;

    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function getLink(string $url): Link
    {
        $link = new Link($url);

        $urlRequest = $this->conn->prepare('SELECT * FROM links WHERE url = ?');
        $urlRequest->execute([$link->getUrl()]);
        $urlResult = $urlRequest->fetch(PDO::FETCH_ASSOC);

        if ($urlResult === false) {
            $prepareRequest = $this->conn->prepare('INSERT INTO links(url) VALUES (?)');
            $prepareRequest->execute([$link->getUrl()]);

            $createdRowStmt = $this->conn->prepare('SELECT * FROM links WHERE id = ?');
            $createdRowStmt->execute([$this->conn->lastInsertId()]);
            $createdRow = $createdRowStmt->fetch(PDO::FETCH_ASSOC);

            $link->setId($createdRow['id']);
            $link->setCreated($createdRow['created']);
            $link->setCode($link->generateCode());

            $updateUrlCode = $this->conn->prepare('UPDATE links SET code = ? WHERE id = ?');
            $updateUrlCode->execute([$link->getCode(), $link->getId()]);
        } else {
            $link->setId($urlResult['id']);
            $link->setCreated($urlResult['created']);
            $link->setCode($urlResult['code']);
        }

        return $link;
    }
}