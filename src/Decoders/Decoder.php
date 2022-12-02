<?php

namespace Habibeh92\Converter\Decoders;


interface Decoder
{
    /**
     * Decode the data to an entity instance
     *
     * @param string $data
     *
     * @return object
     */
    public function handle($data): array;
}
