<?php

declare(strict_types=1);

require __DIR__ .'/vendor/autoload.php';

use Doctrine\ORM\EntityManagerInterface;
use Sony\Sony\Controller\AbstractResponse;
use Sony\Sony\Controller\EmployeeController;
use Sony\Sony\Container\Container;
use Sony\Sony\Factory\EntityFactory;

$container = new Container();
$container->addFactory(EntityManagerInterface::class, [EntityFactory::class, 'getEntityManager']);

try {
    $controller = $container->get(EmployeeController::class);

    $operation = $_GET['action'] ?? null;

    $operation = 'getAllEmployees';

    if (method_exists($controller, $operation)) {
        /** @var AbstractResponse $response */
        $response = $controller->{$operation}();
        $response->sendHeaders();

        print $response;
    }
} catch (ReflectionException $e) {
    print $e->getMessage();
}