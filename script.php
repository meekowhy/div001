<?php

include_once __DIR__ . '/app/CsvReader.php';
include_once __DIR__ . '/app/algorithms/KnapsackFactory.php';


if (count($argv) < 3) {
    echo "The script needs at least two additional arguments. \nPlease provide relative path to CSV file as first argument, a number describing bag's capacity as second argument and optionally a number describing a method to solve a problem. \n";
    die;
}

$filePath = ($argv[1][0] != '/') ? __DIR__.'/'.$argv[1] : __DIR__.$argv[1];

if (!file_exists($filePath)) {
    echo "File doesn't exist. \n";
    die;
}

$fileInfo = pathinfo($filePath);

if ($fileInfo['extension'] != 'csv') {
    echo "Wrong file extension. Please provide csv file format \n";
}

$capacity = $argv[2];

if (!is_numeric($capacity)) {
    echo "Please provide a number describing bag's capacity.\n";
    die;
}

$method = isset($argv[3]) ? KnapsackFactory::create($argv[3]) : KnapsackFactory::create();

if (!$method) {
    echo "No such method. Please provide a number describing a method you want to use or use default method by leaving the parameter blank. \n";
    die;
}


$csvReader = new CsvReader();
$csvArr = $csvReader->csvToArray($filePath);
try {
    $params = $method->prepareParams($csvArr);
} catch (Exception $e) {
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

