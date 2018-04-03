<?php

namespace App;

class CsvReader
{

    /**
     * @param $file
     * @return array
     * @throws \Exception
     */
    public static function csvToArray($file)
    {
        $csv = array_map('str_getcsv', file($file));
        if (!isset($csv[0])) {
            throw new \Exception("Wrong data format! (check you csv file) \n");
        }
        $columns = explode(';',$csv[0][0]);
        if (count($columns) < 3) {
            throw new \Exception("Wrong data format! (check you csv file) \n");
        }
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

