<?php

namespace App;

class CsvReader
{
    public static function csvToArray($file)
    {
        $csv = array_map('str_getcsv', file($file));
        array_shift($csv)[0];
        $ids = array();
        $weights = array();
        $values = array();
        foreach ($csv as $key=>$value) {
            $row = explode(';',$value[0]);
            $ids[] = $row[0];
            $weights[] = $row[1];
            $values[] = $row[2];
        }

        return [
            'ids' =>  $ids,
            'weights' => $weights,
            'values' => $values
        ];
    }

}

