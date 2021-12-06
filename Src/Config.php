<?php


namespace Src;


class Config
{
    private string $host;
    private int $port;
    private string $dbName;
    private string $userName;
    private string $pass;

    /**
     * Config constructor.
     * @param string $host
     * @param int $port
     * @param string $dbName
     * @param string $userName
     * @param string $pass
     */
    public function __construct(string $host, int $port, string $dbName, string $userName, string $pass)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {
        return $this->dbName;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }
}