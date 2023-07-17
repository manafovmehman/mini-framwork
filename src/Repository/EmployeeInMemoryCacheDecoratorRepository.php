<?php

namespace Sony\Sony\Repository;

class EmployeeInMemoryCacheDecoratorRepository extends EmployeeRepository
{
    protected array $testData = ['name' => 'Mehman', 'position' => 'Software Engineer'];

    protected EmployeeRepository $fallback;

    public function __construct(EmployeeRepository $fallback)
    {
        $this->fallback = $fallback;
    }

    public function getAllEmployees($message): array
    {
        return $this->testData;
    }

    public function getManagers(): array
    {
        return $this->testData;
    }

    public function getEmployeesWithMultipleProjects(): array
    {
        return $this->testData;
    }
}