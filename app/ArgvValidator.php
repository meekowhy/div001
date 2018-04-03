<?php

namespace App;

class ArgvValidator
{

    /**
     * @param array $argv
     * @return bool
     * @throws \Exception
     */
    public static function validateArgumentsNo(array $argv)
    {
        if (count($argv) < 3) {
            throw new \Exception("The script needs at least two arguments. \nPlease provide relative path to CSV file as first argument, a number describing bag's capacity as second argument and optionally a number describing a method to solve a problem. \n");
        }
        return true;
    }

    /**
     * @param $filePath
     * @return bool
     * @throws \Exception
     */
    public static function validateFilePath($filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File doesn't exist. \n");
        }
        return true;
    }

    /**
     * @param $filePath
     * @return bool
     * @throws \Exception
     */
    public static function validateFileExtension($filePath)
    {
        $fileInfo = pathinfo($filePath);

        if ($fileInfo['extension'] != 'csv') {
            throw new \Exception("Wrong file extension. Please provide csv file format \n");
        }
        return true;
    }

    /**
     * @param $capacity
     * @return bool
     * @throws \Exception
     */
    public static function validateCapacityArgument($capacity)
    {
        if (!is_numeric($capacity) || $capacity < 0) {
            throw new \Exception("Please provide a nonnegative number describing bag's capacity.\n");
        }
        return true;
    }

    /**
     * @param $method
     * @return bool
     * @throws \Exception
     */
    public static function validateMethodArgument($method)
    {
        if (!is_numeric($method)) {
            throw new \Exception("Please provide a number describing a method you want to use.\n");
        }
        return true;
    }

}