<?php

use PHPUnit\Framework\TestCase;
use App\CsvReader;

class CsvReaderTest extends TestCase {

    public function testCsvToArray()
    {
        $this->assertInternalType('array', CsvReader::csvToArray(__DIR__ . '/../assets/dane.csv'));
        $this->assertContains(['item_id' => 20, 'item_weight' => 17,'item_value' => 5], CsvReader::csvToArray(__DIR__ . '/../assets/dane.csv'));
    }


}