<?php

namespace Sony\Sony\Controller;

class AbstractResponse
{
    protected array $headers = [];

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    public function sendHeaders(): void
    {
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    public function __toString(): string
    {
        return '';
    }
}