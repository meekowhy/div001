<?php

include_once __DIR__ . '/Knapsack1.php';
include_once __DIR__ . '/Knapsack2.php';

class KnapsackFactory
{
    public static function create($param = null)
    {

        switch ($param) {
            case null:
                $knapsack = new Knapsack1();
                break;
            case 1:
                $knapsack = new Knapsack1();
                break;
            case 2:
                $knapsack = new Knapsack2();
                break;
            default:
                $knapsack = null;
                break;
        }

        return $knapsack;

    }
}