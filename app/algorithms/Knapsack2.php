<?php

include_once __DIR__ . '/KnapsackAbstract.php';

class Knapsack2 extends KnapsackAbstract
{
    /**
     * @var array
     */
    private $table = array();

    /**
     * @param $items
     * @param $capacity
     * @return array
     */
    public function solve(array $ids, array $weights, array $values, $capacity)
    {
        $result = $this->knapSolveFast($weights, $values, count($weights) - 1, $capacity, $this->table);
        $chosenItems = array();
        $totalWeight = 0;
        foreach ($result[1] as $i) {
            $chosenItems[] = $ids[$i];
            $totalWeight += $weights[$i];
        }
        return [
            'total_value' => $result[0],
            'total_weight' => $totalWeight,
            'chosen_items' => $chosenItems
        ];

    }

    /**
     * @param $w
     * @param $v
     * @param $i
     * @param $capacity
     * @param $m
     * @return array
     * http://rosettacode.org/wiki/Knapsack_problem/0-1#PHP
     */
    private function knapSolveFast($w, $v, $i, $capacity, &$m) {

        // Return memo if we have one
        if (isset($m[$i][$capacity])) {
            return array( $m[$i][$capacity], $m['picked'][$i][$capacity] );
        } else {
            // At end of decision branch
            if ($i == 0) {
                if ($w[$i] <= $capacity) { // Will this item fit?
                    $m[$i][$capacity] = $v[$i]; // Memo this item
                    $m['picked'][$i][$capacity] = array($i); // and the picked item
                    return array($v[$i],array($i)); // Return the value of this item and add it to the picked list

                } else {
                    // Won't fit
                    $m[$i][$capacity] = 0; // Memo zero
                    $m['picked'][$i][$capacity] = array(); // and a blank array entry...
                    return array(0,array()); // Return nothing
                }
            }

            // Not at end of decision branch..
            // Get the result of the next branch (without this one)
            list ($without_i, $without_PI) = $this->knapSolveFast($w, $v, $i-1, $capacity, $m);

            if ($w[$i] > $capacity) { // Does it return too many?

                $m[$i][$capacity] = $without_i; // Memo without including this one
                $m['picked'][$i][$capacity] = $without_PI; // and a blank array entry...
                return array($without_i, $without_PI); // and return it

            } else {
                // Get the result of the next branch (WITH this one picked, so available weight is reduced)
                list ($with_i,$with_PI) = $this->knapSolveFast($w, $v, ($i-1), ($capacity - $w[$i]), $m);
                $with_i += $v[$i];  // ..and add the value of this one..

                // Get the greater of WITH or WITHOUT
                if ($with_i > $without_i) {
                    $res = $with_i;
                    $picked = $with_PI;
                    array_push($picked,$i);
                } else {
                    $res = $without_i;
                    $picked = $without_PI;
                }

                $m[$i][$capacity] = $res; // Store it in the memo
                $m['picked'][$i][$capacity] = $picked; // and store the picked item
                return array ($res,$picked); // and then return it
            }
        }
    }
}