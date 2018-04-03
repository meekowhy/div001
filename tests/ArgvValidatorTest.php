<?php

use PHPUnit\Framework\TestCase;
use App\ArgvValidator;

class ArgvValidatorTest extends TestCase {

    /**
     * @expectedException Exception
     */
    public function testExceptionNoArguments()
    {
        ArgvValidator::validateArguments([]);
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionToLittleArguments()
    {
        ArgvValidator::validateArguments([1,2]);
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionNegativeCapacity()
    {
        ArgvValidator::validateArguments(['phpscript',1,-1,3]);
    }


    public function testNoExceptionArguments()
    {
        $this->assertTrue(ArgvValidator::validateArguments(['phpscript',1,1,3]));
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionNoFile()
    {
        ArgvValidator::validateFile('asdasd/sdsa/sssssss');
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionWrongExtension()
    {
        ArgvValidator::validateFile('asdasd.exe');
    }

    public function testNoExceptionFile()
    {
        $this->assertTrue(ArgvValidator::validateFile(__DIR__ . '/../assets/dane.csv'));
    }


}