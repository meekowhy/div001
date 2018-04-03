<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/Algorithm/Knapsack1.php';
require __DIR__ .'/../app/CsvReader.php';


class Knapsack1Test extends TestCase {

    private $csvArr;
    private $method;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->csvArr = (new CsvReader())->csvToArray(__DIR__ . '/../assets/dane.csv');
        $this->method = new Knapsack1();
    }

    public function testSolve()
    {
        $this->assertEquals($this->method->solve($this->csvArr,0),['total_value' => 0, 'total_weight' => 0, 'chosen_items' => []]);
        $this->assertEquals($this->method->solve($this->csvArr,1),['total_value' => 69, 'total_weight' => 1, 'chosen_items' => [8]]);
    }

}