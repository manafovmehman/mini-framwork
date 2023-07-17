<?php

namespace Sony\Sony\Controller;

class JsonResponse extends AbstractResponse
{
    private array $response;

    public function __construct(array $response)
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';
        $this->response = $response;
    }

    public function __toString(): string
    {
        return json_encode($this->response);
    }
}