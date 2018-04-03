<?php

namespace App\Algorithm;

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