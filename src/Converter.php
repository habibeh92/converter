<?php

namespace Habibeh92\Converter;


use Habibeh92\Converter\Decoders\Decoder;

class Converter
{
    /**
     * @var Decoder
     */
    private Decoder $decoder;



    /**
     * Context constructor.
     *
     * @param Converter $decoder
     */
    public function __construct(Decoder $decoder)
    {
        $this->decoder = $decoder;
    }



    /**
     * run the decoder handle method.
     *
     * @param object $entity
     * @param string $data
     *
     * @return object
     */
    public function handle(object $entity, $data): object
    {
        return Decorator::handle($entity, $this->decoder->handle($data));
    }

}
