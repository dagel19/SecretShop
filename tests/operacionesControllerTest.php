<?php

use App\Controllers\OperacionesController;
use PHPUnit\Framework\TestCase;

class operacionesControllerTest extends TestCase
{
    public function test_suma_de_dos_numeros()
    {

        $n1 = 5;
        $n2 = 6;
        $obj = new OperacionesController();
        $expected = 11;

        //Action
        $actual = $obj->suma($n1, $n2);

        //Assert
        $this->assertEquals($expected, $actual);
    }
}
