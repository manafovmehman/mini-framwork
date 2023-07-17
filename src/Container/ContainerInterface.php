<?php

namespace Sony\Sony\Container;

interface ContainerInterface
{
    public function get(string $class): object;

    public function addFactory(string $class, callable $callable): void;
}