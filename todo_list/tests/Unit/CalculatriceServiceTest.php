<?php
use PHPUnit\Framework\TestCase ;
use App\Services\CalculatriceService;

class CalculatriceServiceTest extends TestCase
{
    public function testSomme()
    {
        $calc = new CalculatriceService();
        

        $this->assertEquals(5, $calc->somme(2, 3));
    }
}