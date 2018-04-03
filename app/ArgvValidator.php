<?php

namespace App;

class ArgvValidator
{

    /**
     * @param $file
     * @return bool
     * @throws \Exception
     */
    public static function validateFile($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("File doesn't exist. \n");
        }

        $fileInfo = pathinfo($file);

        if ($fileInfo['extension'] != 'csv') {
            throw new \Exception("Wrong file extension. Please provide csv file format \n");
        }
        return true;
    }

    /**
     * @param array $argv
     * @return bool
     * @throws \Exception
     */
    public static function validateArguments(array $argv)
    {
        if (count($argv) < 3) {
            throw new \Exception("The script needs at least two arguments. \nPlease provide relative path to CSV file as first argument, a number describing bag's capacity as second argument and optionally a number describing a method to solve a problem. \n");
        }

        if (!is_numeric($argv[2]) || $argv[2] < 0) {
            throw new \Exception("Please provide a nonnegative number describing bag's capacity.\n");
        }

        if (isset($argv[3])) {
            if (!is_numeric($argv[3])) {
                throw new \Exception("Please provide a number describing a method you want to use.\n");
            }
        }

        return true;
    }

}