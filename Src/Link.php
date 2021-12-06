<?php

namespace Src;

class Link
{
    private const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyz';

    public int $id = 0;
    public string $code = '';
    public string $created;
    private string $url;

    public function __construct(string $url)
    {
        $this->url = trim($url);
    }

    public function generateCode(int $length): string
    {
        return substr(str_shuffle(self::PERMITTED_CHARS), 0, $length);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): void
    {
        $this->code = $created;
    }
}

