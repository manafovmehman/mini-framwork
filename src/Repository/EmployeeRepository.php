<?php

declare(strict_types=1);

namespace Sony\Sony\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Sony\Sony\Message\EmployeeGetMessage;

class EmployeeRepository implements Repository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Exception
     */
    public function getAllEmployees(EmployeeGetMessage $message): array
    {
        $sql = "SELECT e.*, d.name as department_name, j.title, e2.name as employee_manager_2, e3.name as dep_manager FROM employee e
        LEFT JOIN departments d ON d.id=e.department
        LEFT JOIN jobs j ON j.id=e.job_title
        LEFT JOIN employee e2 ON e2.id=e.employee_manager
        LEFT JOIN employee e3 ON e3.id=e.department_manager
        WHERE salary > ?";


        $query = $this->entityManager->createNativeQuery($sql, new ResultSetMapping());
        $query->setParameter(1, $message->getSalary());

        return $query->getResult();
    }

    /**
     * @throws \Exception
     */
    public function getManagers(): array
    {
        $sql = "SELECT e2.name FROM employee e
        INNER JOIN employee e2 ON e.employee_manager=e2.id";

        $query = $this->entityManager->createNativeQuery($sql, new ResultSetMapping());

        return $query->getResult();
    }

    /**
     * @throws \Exception
     */
    public function getEmployeesWithMultipleProjects(): array
    {
        $sql = "SELECT e.* FROM employee e
        INNER JOIN employee_projects ep ON e.id=ep.employee
        GROUP BY e.id
        HAVING COUNT(e.id) > 1";

        $query = $this->entityManager->createNativeQuery($sql, new ResultSetMapping());

        return $query->getResult();
    }
}