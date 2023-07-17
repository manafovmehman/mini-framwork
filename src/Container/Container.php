<?php

namespace Sony\Sony\Container;

class Container implements ContainerInterface
{
    protected array $pool = [];

    /**
     * @throws \ReflectionException
     */
    public function get(string $class): object
    {
        if (array_key_exists($class, $this->pool)) {
            return $this->pool[$class];
        }

        $params = $this->getParams($class);

        $objects = [];

        foreach ($params as $param) {
            $objects[$param] = $this->get($param);
        }

        $object = new $class(...array_values($objects));

        $this->pool[$class] = $object;

        return $object;
    }

    public function addFactory(string $class, callable $callable): void
    {
        $this->pool[$class] = $callable();
    }

    /**
     * @throws \ReflectionException
     */
    protected function getParams(string $class): array
    {
        $result = [];
        $reflection = new \ReflectionClass($class);
        $params = $reflection->getConstructor()->getParameters();

        foreach ($params as $param) {
            $result[] = $param->getType()->getName();
        }

        return $result;
    }
}