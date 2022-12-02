<?php

namespace Habibeh92\Converter\Tests\Feature\Providers;

use Habibeh92\Converter\Decoders\Decoder;
use Habibeh92\Converter\Decoders\XmlDecoder;
use Habibeh92\Converter\Tests\Feature\Entities\Data;

/**
 * Sample XML API provider
 */
class SecondAPIProvider implements APIProvider
{
    /**
     * @inheritDoc
     */
    public function entity(): object
    {
        return new Data();
    }



    /**
     * @inheritDoc
     */
    public function decoder(): Decoder
    {
        return new XmlDecoder();
    }



    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return "tests/Feature/resources/data.xml";
    }

}
