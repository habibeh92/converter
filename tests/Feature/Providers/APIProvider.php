<?php

namespace Habibeh92\Converter\Tests\Feature\Providers;

use Habibeh92\Converter\Decoders\Decoder;

interface APIProvider
{
    /**
     * get the instance of the entity
     *
     * @return object
     */
    public function entity(): object;



    /**
     * get the instance of the converter
     *
     * @return Decoder
     */
    public function decoder(): Decoder;



    /**
     * get the path of data
     *
     * @return string
     */
    public function path(): string;

}
