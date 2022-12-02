<?php

namespace Habibeh92\Converter\Tests\Feature;

use Habibeh92\Converter\Tests\Feature\Entities\Data;
use Habibeh92\Converter\Tests\Feature\Entities\Ticker;
use Habibeh92\Converter\Tests\Feature\Providers\APIService;
use Habibeh92\Converter\Tests\Feature\Providers\FirstAPIProvider;
use Habibeh92\Converter\Tests\Feature\Providers\SecondAPIProvider;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Habibeh92\Converter\Converter
 * @covers \Habibeh92\Converter\Decorator
 */
class APIServiceTest extends TestCase
{

    /**
     * test JSON response
     */
    public function test_json_response()
    {
        $response = (new APIService())->execute(new FirstAPIProvider());
        $this->checkDataStructure($response);
    }



    /**
     * test XML response
     */
    public function test_xml_response()
    {
        $response = (new APIService())->execute(new SecondAPIProvider());
        $this->checkDataStructure($response);

    }



    /**
     * check assertions on the data structure
     *
     * @param $response
     */
    private function checkDataStructure($response)
    {
        $this->assertInstanceOf(Data::class, $response);
        $this->assertIsArray($response->data);
        foreach ($response->data as $ticker) {
            $this->assertInstanceOf(Ticker::class, $ticker);
            $this->assertIsString($ticker->slug);
            $this->assertIsString($ticker->title);
            $this->assertIsString($ticker->symbol);
            $this->assertIsInt($ticker->rank);
            $this->assertIsFloat($ticker->price);
            $this->assertIsFloat($ticker->volume);
        }
    }
}
