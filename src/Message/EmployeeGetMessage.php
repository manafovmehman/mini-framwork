<?php

declare(strict_types=1);

namespace Sony\Sony\Message;

class EmployeeGetMessage
{
    private ?float $salary = null;

    private function __construct(array $request)
    {
        $this->salary = $request['salary'] ?? null;
    }

    public static function createFromRequest(array $request): static
    {
        return new static($request);
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }
}