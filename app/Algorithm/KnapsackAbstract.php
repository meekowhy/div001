<?php

namespace App\Algorithm;

abstract class KnapsackAbstract
{
    abstract public function solve(array $ids, array $weights, array $values, $capacity);

    public function prepareParams(array $items)
    {
        $ids = array();
        $weights = array();
        $values = array();

        foreach ($items as $item) {
            if (!isset($item['item_id']) || !isset($item['item_weight']) || !isset($item['item_value'])) {
                throw new Exception("Wrong data format! (check you csv file) \n");
            }
            $ids[] = $item['item_id'];
            $weights[] = $item['item_weight'];
            $values[] = $item['item_value'];
        }

        return [
            'ids' =>  $ids,
            'weights' => $weights,
            'values' => $values
        ];
    }


}