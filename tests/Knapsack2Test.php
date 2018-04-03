<?php

use PHPUnit\Framework\TestCase;
use App\Algorithm\KnapsackFactory;

class Knapsack2Test extends TestCase {

    public function testSolve()
    {
        $method = KnapsackFactory::create(1);
        $this->assertEquals(['total_value' => 0, 'total_weight' => 0, 'chosen_items' => []],$method->solve([1,2,3],[3,2,1],[5,6,7],0));
        $this->assertEquals(['total_value' => 7, 'total_weight' => 1, 'chosen_items' => [3]],$method->solve([1,2,3],[3,2,1],[5,6,7],1));
        $this->assertEquals(['total_value' => 7, 'total_weight' => 1, 'chosen_items' => [3]],$method->solve([1,2,3],[3,2,1],[5,6,7],1.9));
        $this->assertEquals(['total_value' => 13, 'total_weight' => 3, 'chosen_items' => [2,3]],$method->solve([1,2,3],[3,2,1],[5,6,7],4), "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

}