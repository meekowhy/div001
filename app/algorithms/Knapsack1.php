<?php

include_once __DIR__ . '/KnapsackInterface.php';

class Knapsack1 implements KnapsackInterface
{
    private $table = array();

    public function solve(array $items, $capacity)
    {
        $ids = array();
        $weights = array();
        $values = array();

        foreach ($items as $item) {
            $ids[] = $item['item_id'];
            $weights[] = $item['item_weight'];
            $values[] = $item['item_value'];
        }

        return $this->mySolve($weights, $values, $ids, count($ids), (int)$capacity, $this->table);
    }

    public function mySolve($weights, $values, $items, $num_items, $capacity, &$m)
    {

        //create 2D table of 0s
        for ($row = 0; $row <= $capacity; $row++) {
            for($col = 0; $col <= $num_items; $col++ ) {
                $m[$row][$col] = 0;
            }
        }

        for ($j = 1; $j < $num_items+1; $j++) {
            $value = $values[$j-1];
            $weight = $weights[$j-1];

            for ($i = 1; $i < $capacity+1; $i++) {
                if ($weight > $i) {
                    $m[$i][$j] = $m[$i][$j-1];
                } else {
                    $m[$i][$j] = max($m[$i][$j-1],$m[$i-$weight][$j-1] + $value);
                }
            }

        }

        $remainingCapacity = $capacity;
        $totalWeight = 0;
        $totalValue = 0;
        $chosenItems = array();

        for ($i = $num_items; $i > 0; $i--) {
            if ($m[$remainingCapacity][$i] != $m[$remainingCapacity][$i-1]) {
                $weight = $weights[$i-1];
                $totalWeight += $weight;
                $totalValue += $values[$i-1];
                $chosenItems[] = $items[$i-1];
                $remainingCapacity = $remainingCapacity - $weight;
            }
        }

        return [
            'total_value' => $totalValue,
            'total_weight' => $totalWeight,
            'chosen_items' => $chosenItems
        ];

    }
}
