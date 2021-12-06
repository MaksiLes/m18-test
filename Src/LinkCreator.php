<?php

namespace Src;

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
        $urlResult = $urlRequest->fetch();

        if ($urlResult === false) {
            $unique = false;
            $createdRowStmt = $this->conn->prepare('SELECT * FROM links WHERE code = ?');
            do {
                $code = $link->generateCode(6);

                $createdRowStmt->execute([$code]);
                if ($createdRowStmt->fetch()) {
                    continue;
                }

                $prepareRequest = $this->conn->prepare('INSERT INTO links(url, code) VALUES (?, ?)');
                $prepareRequest->execute([$link->getUrl(), $code]);

                $unique = true;
            } while (!$unique);

            $link->setCode($code);
            $link->setId($this->conn->lastInsertId());
        } else {
            $link->setId($urlResult['id']);
            $link->setCreated($urlResult['created']);
            $link->setCode($urlResult['code']);
        }

        return $link;
    }
}