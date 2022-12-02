<?php

namespace Habibeh92\Converter\Decoders;


class XmlDecoder implements Decoder
{
    /**
     * @inheritDoc
     */
    public function handle($data): array
    {
        return json_decode(json_encode(simplexml_load_string($data)), true);
    }
}
