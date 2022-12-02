<?php

namespace Habibeh92\Converter\Tests\Feature\Providers;

use Habibeh92\Converter\Decoders\Decoder;
use Habibeh92\Converter\Decoders\JsonDecoder;
use Habibeh92\Converter\Tests\Feature\Entities\Data;


/**
 * Sample JSON API provider
 */
class FirstAPIProvider implements APIProvider
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
        return new JsonDecoder();
    }



    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return "tests/Feature/resources/data.json";
    }
}
