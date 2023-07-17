<?php

declare(strict_types=1);

namespace Sony\Sony\Controller;

use Sony\Sony\Message\EmployeeGetMessage;
use Sony\Sony\Repository\EmployeeInMemoryCacheDecoratorRepository;

class EmployeeController extends EmployeeAbstractBaseController
{
    private EmployeeInMemoryCacheDecoratorRepository $employeeRepository;

    public function __construct(EmployeeInMemoryCacheDecoratorRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @throws \Exception
     */
    public function getAllEmployees(): AbstractResponse
    {
        $message = EmployeeGetMessage::createFromRequest($_GET);

        return new JsonResponse($this->employeeRepository->getAllEmployees($message));
    }

    /**
     * @throws \Exception
     */
    public function getAllManagers(): AbstractResponse
    {
        return new JsonResponse($this->employeeRepository->getManagers());
    }

    /**
     * @throws \Exception
     */
    public function getEmployeesWithMultipleProjects(): AbstractResponse
    {
        return new JsonResponse($this->employeeRepository->getEmployeesWithMultipleProjects());
    }
}