<?php

use PHPUnit\Framework\TestCase;
use App\CsvReader;

class CsvReaderTest extends TestCase {

    public function testCsvToArray()
    {
        $this->assertInternalType('array', CsvReader::csvToArray(__DIR__ . '/../assets/dane.csv'));
    }


}