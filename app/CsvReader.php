<?php

namespace App;

class CsvReader
{
    public static function csvToArray($file)
    {
        $csv = array_map('str_getcsv', file($file));
        $columns = explode(';', array_shift($csv)[0]);
        $array = array();
        foreach ($csv as $key=>$value) {
            $row = explode(';',$value[0]);
            $i = 0;
            $arr = array();
            foreach ($columns as $k => $v) {
                $arr[$columns[$i]] = $row[$i];
                $i++;
            }
            $array[] = $arr;
        }
        return $array;
    }

}

