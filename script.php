<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\CsvReader;
use App\ArgvValidator;
use App\Algorithm\KnapsackFactory;

try {
    ArgvValidator::validateArgumentsNo($argv);
} catch (\Exception $e) {
    echo $e->getMessage();die;
}

$filePath = ($argv[1][0] != '/') ? __DIR__.'/'.$argv[1] : __DIR__.$argv[1];

try {
    ArgvValidator::validateFilePath($filePath);
} catch (\Exception $e) {
    echo $e->getMessage();die;
}

try {
    ArgvValidator::validateFileExtension($filePath);
} catch (\Exception $e) {
    echo $e->getMessage();die;
}

$capacity = $argv[2];

try {
    ArgvValidator::validateCapacityArgument($capacity);
} catch (\Exception $e) {
    echo $e->getMessage();die;
}

if (isset($argv[3])) {
    try {
        ArgvValidator::validateMethodArgument($argv[3]);
    } catch (\Exception $e) {
        echo $e->getMessage();die;
    }
}

$method = isset($argv[3]) ? KnapsackFactory::create($argv[3]) : KnapsackFactory::create();

if (!$method) {
    echo "No such method. Please provide a number describing a method you want to use or use default method by leaving the parameter blank. \n";
    die;
}

$csvArr = CsvReader::csvToArray($filePath);

try {
    $params = $method->prepareParams($csvArr);
} catch (\Exception $e) {
    echo $e->getMessage();die;
}

$result = $method->solve($params['ids'],$params['weights'],$params['values'],$capacity);

echo "Bag's capacity: \n" . $capacity . "\n";
echo "Chosen items: \n";
foreach ($result['chosen_items'] as $item) {
    echo $item . "\n";
}
echo "Total weight: \n" . $result['total_weight'] . "\n";
echo "Total value: \n" . $result['total_value'] . "\n";

