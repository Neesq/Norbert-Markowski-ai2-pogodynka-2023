<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Measurement;
class MeasurementTest extends TestCase
{
    public function dataGetFahrenheit(): array
    {
        return [
            ['0', 32],
            ['-100', -148],
            ['100', 212],
            ['20', 68],
            ['50', 122],
            ['37', 98.6],
            ['10', 50],
            ['60', 140],
            ['23.5', 74.3],
            ['-273.15', -459.67],
        ];
    }
    /**
        @dataProvider dataGetFahrenheit
     * 
     */
    public function testGetFahrenheit($celsius, $expectedFahrenheit): void
    {
        $measurement = new Measurement();
        $measurement->setCelsius($celsius);
        $this->assertEquals($expectedFahrenheit, $measurement->getFahrenheit());
    }
}
