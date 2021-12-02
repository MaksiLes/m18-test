<?php

namespace Src;

class Link
{
    public int $id = 0;
    public string $code = '';
    public string $created;
    private string $url;

    public function __construct(string $url)
    {
        $this->url = trim($url);
    }

    public function generateCode()
    {
        return (string)$this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        return $this->code = $code;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        return $this->code = $created;
    }
}

