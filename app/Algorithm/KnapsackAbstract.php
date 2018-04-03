<?php

namespace App\Algorithm;

abstract class KnapsackAbstract
{
    abstract public function solve(array $ids, array $weights, array $values, $capacity);

}