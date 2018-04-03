<?php

use PHPUnit\Framework\TestCase;
use App\Algorithm\KnapsackFactory;
use App\ArgvValidator;

class ArgvValidatorTest extends TestCase {

    /**
     * @expectedException Exception
     */
    public function testExceptionValidateNoArguments()
    {
        ArgvValidator::validateArgumentsNo([]);
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionValidateToLittleArguments()
    {
        ArgvValidator::validateArgumentsNo([1,2]);
    }


    public function testNoExceptionValidateArgumentsNo()
    {
        $this->assertTrue(ArgvValidator::validateArgumentsNo([1,2,3]));
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionNoFile()
    {
        ArgvValidator::validateFilePath('asdasd/sdsa/sssssss');
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionWrongExtension()
    {
        ArgvValidator::validateFileExtension('asdasd.exe');
    }

    public function testNoExceptionFile()
    {
        $this->assertTrue(ArgvValidator::validateFilePath(__DIR__ . '/../assets/dane.csv'));
    }


}